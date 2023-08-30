<template>
    <footer
        id="footer"
        class="footerBgColor supports-backdrop-blur:bg-white/60 fixed bottom-0 right-0 z-40 w-full overflow-hidden border-t px-4 backdrop-blur transition-colors duration-500 dark:border-slate-50/[0.06] md:flex md:items-center md:justify-between lg:border-slate-900/10"
    >
        <u class="footer-menu w-full lg:hidden">
            <li>
                <router-link to="/">
                    <i class="bi bi-house-fill"></i>Home
                </router-link>
            </li>
            <li>
                <router-link to="/dashboard?coin=true">
                    <i class="bi bi-bar-chart-line-fill"></i>Buy Coins
                </router-link>
            </li>
            <li>
                <a @click.prevent="goTo(`${homeUrl}/user/referal`)">
                    <i class="bi bi-person-add"></i>Invite
                </a>
            </li>
            <li>
                <router-link to="/binary/trade/BTC/USDT">
                    <i class="bi bi-arrow-left-right"></i>Trade
                </router-link>
            </li>
            <li>
                <router-link to="/binary" exact>
                    <i class="bi bi-wallet-fill"></i>Asset
                </router-link>
            </li>
        </u>
    </footer>
    <div
        id="dropdownLanguage"
        class="z-50 w-44 divide-y divide-gray-100 rounded bg-white shadow dark:divide-gray-600 dark:bg-gray-700"
        style="
            position: fixed;
            inset: auto auto 0px 0px;
            margin: 0px;
            max-height: 280px;
            overflow-y: auto;
        "
        :style="{
            left: dropdownPosition.left,
            top: dropdownPosition.top,
        }"
        :class="{ hidden: !languageDropdownVisible }"
    >
        <ul class="py-1" role="none">
            <li v-for="(locale, key, index) in locales" :key="index">
                <a
                    class="block border-b-2 border-gray-200 text-sm text-gray-700 hover:bg-gray-100 dark:border-gray-800 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                    role="menuitem"
                    @click="selectLang(key)"
                >
                    <div class="inline-flex items-center px-3 py-1">
                        <img
                            v-lazy="'/assets/flags/' + locale.icon + '.svg'"
                            class="mr-2 h-3.5 w-3.5 rounded-full"
                        />
                        {{ locale.lang }} ({{ key }})
                    </div>
                </a>
            </li>
        </ul>
    </div>
    <div
        id="tooltip-expand"
        role="tooltip"
        class="tooltip invisible absolute z-50 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700"
    >
        {{ $t("Expand") }}
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
</template>

<script>
import { ref, computed } from "vue";
export default {
    name: "FooterBar",
    setup() {
        const siteName = ref(window.siteName);
        const dropdownButton = ref(null);
        const dropdownPosition = ref({ left: "0px", top: "0px" });
        const locales = ref({
            ar: { lang: "Arabic", icon: "iq" },
            bn: { lang: "Bengali", icon: "in" },
            de: { lang: "German", icon: "de" },
            en: { lang: "English", icon: "us" },
            es: { lang: "Spanish", icon: "es" },
            fa: { lang: "Farsi", icon: "ir" },
            fr: { lang: "French", icon: "fr" },
            hi: { lang: "Hindi", icon: "in" },
            hu: { lang: "Hungarian", icon: "hu" },
            id: { lang: "Indonesian", icon: "id" },
            it: { lang: "Italian", icon: "it" },
            ja: { lang: "Japanese", icon: "jp" },
            ko: { lang: "Korean", icon: "kr" },
            nb: { lang: "Norwegian", icon: "no" },
            nl: { lang: "Netherlands", icon: "nl" },
            pl: { lang: "Polish", icon: "pl" },
            pt: { lang: "Portuguese", icon: "pt" },
            ru: { lang: "Russain", icon: "ru" },
            th: { lang: "Thai", icon: "th" },
            tr: { lang: "Turkish", icon: "tr" },
            uk: { lang: "Ukrainian", icon: "ua" },
            ur: { lang: "Urdo", icon: "pk" },
            vi: { lang: "Vietnamese", icon: "vn" },
            zh: { lang: "Chinese", icon: "cn" },
        });

        const getCurrentYear = computed(() => new Date().getFullYear());

        async function selectLang(lang) {
            await Trans.switchLanguage(lang);
        }

        function toggleFullScreen() {
            const element = document.documentElement;
            const fullscreenButton =
                document.getElementById("toggleFullScreen");

            if (element.webkitRequestFullscreen) {
                if (document.webkitFullscreenEnabled) {
                    if (!document.webkitFullscreenElement) {
                        element.webkitRequestFullscreen();
                        fullscreenButton.innerHTML =
                            '<path stroke-linecap="round" stroke-linejoin="round" d="M9 9V4.5M9 9H4.5M9 9L3.75 3.75M9 15v4.5M9 15H4.5M9 15l-5.25 5.25M15 9h4.5M15 9V4.5M15 9l5.25-5.25M15 15h4.5M15 15v4.5m0-4.5l5.25 5.25" />';
                    } else {
                        document.webkitExitFullscreen();
                        fullscreenButton.innerHTML =
                            '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />';
                    }
                } else {
                    console.log("Full-screen mode is not enabled.");
                }
            }
        }

        const languageDropdownVisible = ref(false);
        function toggleLanguageDropdown() {
            languageDropdownVisible.value = !languageDropdownVisible.value;
        }
        function handleClickOutside(event) {
            if (!event.target.closest("#dropdownLanguageButton")) {
                languageDropdownVisible.value = false;
            }
        }

        function toggleLanguageDropdown() {
            languageDropdownVisible.value = !languageDropdownVisible.value;
            updateDropdownPosition();
        }

        // Add this in your setup() method
        function updateDropdownPosition() {
            if (dropdownButton.value) {
                const rect = dropdownButton.value.getBoundingClientRect();
                dropdownPosition.value = {
                    left: `${rect.left - 40}px`,
                    top: `${rect.top - 290}px`,
                };
            }
        }

        function handleResize() {
            updateDropdownPosition();
        }

        document.addEventListener("click", handleClickOutside);
        window.addEventListener("resize", handleResize);

        return {
            siteName,
            locales,
            getCurrentYear,
            selectLang,
            toggleFullScreen,
            languageDropdownVisible,
            toggleLanguageDropdown,
            dropdownButton,
            dropdownPosition,
        };
    },
    beforeUnmount() {
        document.removeEventListener("click", handleClickOutside);
        window.removeEventListener("resize", handleResize);
    },
    methods: {
        goTo(url) {
            window.location.href = url;
        },
    },
    computed: {
        homeUrl() {
            return window.location.origin;
        },
    },
};
</script>
