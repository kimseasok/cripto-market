<template>
  <div>
    <h1
      class="mb-5 text-3xl font-bold leading-tight text-gray-900 dark:text-white"
    >
      {{ $t("P2P Trading") }}
    </h1>
    <offers-table />
    <HowP2PWorks />
    <Faqs />
  </div>
</template>

<script>
  import OffersTable from "./components/offers-table.vue";
  import HowP2PWorks from "./components/HowP2PWorks.vue";
  import Faqs from "./components/Faqs.vue";
  import { useUserStore } from "@/store/user";
  import { useRouter } from "vue-router";
  import { onMounted } from "vue";

  export default {
    components: {
      OffersTable,
      HowP2PWorks,
      Faqs,
    },
    setup() {
      const userStore = useUserStore();
      const router = useRouter();
      async function checkKyc() {
        if (
          plat.kyc.kyc_status == 1 &&
          Number(plat.kyc.p2p_restriction) === 1
        ) {
          if (!userStore.user) {
            await userStore.fetch();
          }
          if (!userStore.user.kyc_application) {
            router.push("/identity");
          }
          if (
            userStore.user.kyc_application &&
            userStore.user.kyc_application.level < 2 &&
            userStore.user.kyc_application.status !== "approved"
          ) {
            router.push("/identity");
          }
        }
      }

      onMounted(() => {
        checkKyc();
      });
      return { userStore };
    },
    data() {
      return {};
    },
    methods: {},
  };
</script>
