<template></template>

<script>
  import { DataFeed, widget as TvWidget } from "tradingview-api";

  const supported_resolutions_provider = {
    binance: [
      "1",
      "3",
      "5",
      "15",
      "30",
      "60",
      "120",
      "240",
      "360",
      "480",
      "720",
      "D",
      "W",
      "M",
    ],
    binanceus: [
      "1",
      "3",
      "5",
      "15",
      "30",
      "60",
      "120",
      "240",
      "360",
      "480",
      "720",
      "D",
      "W",
      "M",
    ],
    kucoin: ["1", "5", "15", "30", "60", "240", "D", "W", "M"],
    bitget: ["1", "5", "15", "30", "60", "240", "360", "720", "D", "W"],
  };
  const supported_resolutions = supported_resolutions_provider[provider];
  // 1min, 5min, 15min, 30min, 60min, 4hour, 1day, 1mon, 1week, 1year
  const intervalMap_provider = {
    binance: {
      "1m": "1",
      "3m": "3",
      "5m": "5",
      "15m": "15",
      "30m": "30",
      "1h": "60",
      "2h": "120",
      "4h": "240",
      "6h": "360",
      "8h": "480",
      "12h": "720",
      "1d": "D",
      w: "W",
      m: "M",
    },
    binanceus: {
      "1m": "1",
      "3m": "3",
      "5m": "5",
      "15m": "15",
      "30m": "30",
      "1h": "60",
      "2h": "120",
      "4h": "240",
      "6h": "360",
      "8h": "480",
      "12h": "720",
      "1d": "D",
      w: "W",
      m: "M",
    },
    kucoin: {
      "1m": "1",
      "5m": "5",
      "15m": "15",
      "30m": "30",
      "1h": "60",
      "4h": "240",
      "1d": "D",
      w: "W",
      m: "M",
    },
    bitget: {
      "1m": "1",
      "5m": "5",
      "15m": "15",
      "30m": "30",
      "1h": "60",
      "4h": "240",
      "6h": "360",
      "12h": "720",
      "1d": "D",
      w: "W",
    },
  };

  const intervalDurations = {
    "1": 86400000,
    "3": 259200000,
    "5": 432000000,
    "15": 1296000000,
    "30": 2592000000,
    "60": 5184000000,
    "120": 10368000000,
    "240": 20736000000,
    "320": 31104000000,
    "480": 41472000000,
    "720": 62208000000,
    D: 165888000000,
    W: 1161216000000,
    M: 4976640000000,
  };
  const intervalMap = intervalMap_provider[provider];

  import { useMarketStore } from "@/store/market";
  export default {
    name: "KLineWidget",
    setup() {
      const marketStore = useMarketStore();
      return { marketStore };
    },
    data() {
      return {
        interval: "1h",
        ws: null,
        since: null,
        widget: null,
        duration: 86400000, // milliseconds
        now: Date.now(),
        lastprice: [],
        pair: this.$route.params.symbol + "/" + this.$route.params.currency,
        datafeed: new DataFeed({
          getBars: (params) => this.getBars(params),
          fetchResolveSymbol: () => this.resolveSymbol(),
          fetchConfiguration: () => {
            return new Promise((resolve) => {
              resolve({
                supported_resolutions: supported_resolutions,
              });
            });
          },
        }),
      };
    },
    created() {},
    mounted() {
      this.initTradingView();
      this.parentHeight = this.$parent.$el.offsetHeight;
    },
    methods: {
      resolveSymbol() {
        return new Promise((resolve) => {
          var pair =
            this.$route.params.symbol + "/" + this.$route.params.currency;
          var scale = this.marketStore.bestAsk;
          resolve({
            name: pair,
            full_name: pair,
            description: pair,
            type: pair,
            session: "24x7",
            pricescale: [1, 1, 100],
            exchange: gnl.sitename.toUpperCase(),
            listed_exchange: gnl.sitename.toUpperCase(),
            timezone: "Etc/UTC",
            format: "price",
            minmov: 1,
            has_intraday: true,
            supported_resolutions: supported_resolutions,
            volume_precision: 2,
            data_status: "streaming",
            pricescale: 100,
          });
        });
      },
      async getBars(params) {
        if (!params.firstDataRequest) {
          return {
            bars: [],
            meta: {
              noData: true,
            },
          };
        }
        if (params.resolution !== intervalMap[this.interval]) {
          this.unsubscribeKLine();
          for (let key in intervalMap) {
            if (intervalMap[key] === params.resolution) {
              this.interval = key;
            }
          }
        }
        const res = await this.getKLine(
          this.$route.params.symbol + "/" + this.$route.params.currency
        );
        if (
          params.resolution === intervalMap[this.interval] &&
          params.firstDataRequest &&
          res &&
          res.length
        ) {
          this.subscribeKLine(
            this.$route.params.symbol + "/" + this.$route.params.currency
          );
        }

        if (!res || !res.length) {
          return {
            bars: [],
            meta: { noData: true },
          };
        }
        const list = [];
        for (let i = 0; i < res.length; i++) {
          const item = res[i];
          list.push({
            time: item[0],
            open: item[1],
            high: item[2],
            low: item[3],
            close: item[4],
            volume: item[5],
          });
        }
        list.sort((l, r) => (l.time > r.time ? 1 : -1));
        return {
          bars: list,
          meta: {
            noData: !list.length,
          },
        };
      },
      getRandomInt(min, max) {
        min = Math.ceil(min);
        max = Math.floor(max);
        return Math.floor(Math.random() * (max - min)) + min;
      },
      getKLine(pair) {
        this.duration = intervalDurations[intervalMap[this.interval]] || 0;
        let max = 1000;
        switch (provider) {
          case "binance":
            this.since = this.now - this.duration / 3;
            max = 500;
            break;
          case "kucoin":
            this.since = this.now - this.duration;
            max = 1500;
            break;
          case "bitget":
            this.since = this.now - this.duration / 1.5;
            max = 1000;
            break;

          default:
            this.since = this.now - this.duration;
            max = 1000;
            break;
        }
        try {
          let res = this.marketStore.exchange.fetchOHLCV(
            pair,
            this.interval,
            this.since,
            max
          );
          return res;
        } catch (e) {
          console.log(e.constructor.name, e.message);
          if (e.constructor.name == 419) {
            let res = this.marketStore.exchange.fetchOHLCV(
              pair,
              this.interval,
              this.since
            );
            return res;
          }
        }
      },
      handleTick(tick) {
        const favicon = document.getElementById("favicon");
        this.datafeed.updateKLine({
          time: tick[0],
          open: tick[1],
          high: tick[2],
          low: tick[3],
          close: tick[4],
          volume: tick[5],
        });
        if (
          !this.lastprice[
            this.$route.params.symbol + "/" + this.$route.params.currency
          ] ||
          tick[4] >
            this.lastprice[
              this.$route.params.symbol + "/" + this.$route.params.currency
            ]
        ) {
          document.title =
            tick[4] +
            " | " +
            this.$route.params.symbol +
            "/" +
            this.$route.params.currency;
          favicon.href = "/assets/up.png";
        } else if (
          tick[4] <
          this.lastprice[
            this.$route.params.symbol + "/" + this.$route.params.currency
          ]
        ) {
          document.title =
            tick[4] +
            " | " +
            this.$route.params.symbol +
            "/" +
            this.$route.params.currency;
          favicon.href = "/assets/down.png";
        } else {
          favicon.href = "/assets/neutral.png";
        }
        this.lastprice[
          this.$route.params.symbol + "/" + this.$route.params.currency
        ] = tick[4];
      },
      async subscribeKLine() {
        let res = [];
        while (
          window.location.href.indexOf(
            this.$route.params.symbol + "/" + this.$route.params.currency
          ) > -1
        ) {
          try {
            res[
              this.$route.params.symbol + "/" + this.$route.params.currency
            ] = await this.marketStore.exchange.watchOHLCV(
              this.$route.params.symbol + "/" + this.$route.params.currency,
              this.interval
            );
            this.handleTick(
              res[
                this.$route.params.symbol + "/" + this.$route.params.currency
              ][
                res[
                  this.$route.params.symbol + "/" + this.$route.params.currency
                ].length - 1
              ]
            );
          } catch (e) {
            break;
          }
        }
      },
      async unsubscribeKLine() {
        const connection = this.marketStore.exchange.clients[
          Object.keys(this.marketStore.exchange.clients)[
            Object.keys(this.marketStore.exchange.clients).length - 1
          ]
        ];

        if (provider === "kucoin") {
          const kline_interval = {
            kucoin: {
              "1m": "1min",
              "5m": "5min",
              "15m": "15min",
              "30m": "30min",
              "1h": "1hour",
              "4h": "4hour",
              "1d": "1day",
              w: "1week",
            },
          };
          const klineMap = kline_interval[provider];
          const selectedInterval = klineMap[this.interval];

          for (var key in connection.subscriptions) {
            if (key.includes(`${selectedInterval}`)) {
              const message = {
                id: connection.subscriptions[key]["id"],
                type: "unsubscribe",
                topic: key,
                privateChannel: false,
                response: true,
              };
              connection.send(message);
              // Delete the item from connection.subscriptions
              delete connection.subscriptions[key];
            }
          }
        } else {
          for (var key in connection.subscriptions) {
            const message = {
              id: connection.subscriptions[key]["id"],
              type: "unsubscribe",
              topic: key,
              privateChannel: false,
              response: true,
            };
            connection.send(message);
          }
        }
      },
      initTradingView() {
        const tvChartContainer = document.getElementById("tv_chart_container");
        if (tvChartContainer) {
          tvChartContainer.remove();
        }

        const newChartContainer = document.createElement("div");
        newChartContainer.id = "tv_chart_container";
        newChartContainer.style.height = "100%";

        const creatable = document.querySelector("#creatable");
        creatable.appendChild(newChartContainer);
        var pair =
          this.$route.params.symbol + "/" + this.$route.params.currency;
        this.widget = new TvWidget({
          // debug: true,
          fullscreen: false,
          width: "100%",
          height: "100%",
          symbol: pair,
          interval: intervalMap[this.interval],
          container_id: "tv_chart_container",
          datafeed: this.datafeed,
          library_path: "/charting_library/",
          locale: "en",
          theme: theme == "dark" ? "Dark" : "Light",
          timezone: Intl.DateTimeFormat().resolvedOptions().timeZone,
          allow_symbol_change: false,
          charts_storage_api_version: "1.1",
          client_id: "chart",
          toolbar_bg: "#1F2937",
          disabled_features: [
            "header_compare",
            "study_dialog_search_control",
            "symbol_search_hot_key",
            "header_symbol_search",
            "go_to_date",
            "compare_symbol",
            "timezone_menu",
            "timeframes_toolbar",
          ],
          enabled_features: [
            "dont_show_boolean_study_arguments",
            "use_localstorage_for_settings",
            "save_chart_properties_to_local_storage",
            "side_toolbar_in_fullscreen_mode",
            "hide_last_na_study_output",
            "constraint_dialogs_movement",
            "hide_left_toolbar_by_default",
          ],
        });
        // this.widget.chart().executeActionById("showCountdown");
      },
      setSymbol(symbol) {
        this.unsubscribeKLine();
        this.symbol = symbol;
        this.widget.setSymbol(symbol, intervalMap[this.interval], () => {
          console.log("------setSymbol---------", this.symbol);
        });
      },
    },
  };
</script>
