<template>
  <div>
    <div
      class="mt-2 flex items-center justify-between border-gray-200 py-1 px-3 text-sm font-medium uppercase text-gray-500 dark:border-gray-700 dark:text-gray-400"
    >
      <h3>{{ $t("Categories") }}</h3>
    </div>
    <hr class="border-gray-200 dark:border-gray-700" />
    <ul class="space-y-1 p-2 hidden sm:block">
      <li>
        <a
          class="flex items-center rounded-lg p-2 text-base font-normal text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
          :class="
            selectedCategoryId === null
              ? 'border-l-4 border-blue-400 bg-gray-100 dark:bg-gray-700'
              : ''
          "
          @click="resetCategoryFilter"
        >
          <svg
            aria-hidden="true"
            class="h-6 w-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
            fill="currentColor"
            viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
            <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
          </svg>
          <span
            class="ml-3"
            :class="{
              'text-black dark:text-white': selectedCategoryId === null,
              'text-black dark:text-white': selectedCategoryId !== null,
            }"
            >{{ $t("All") }}</span
          >
        </a>
      </li>
      <li
        v-for="(category, index) in categories"
        :key="index"
        class="flex items-center rounded-lg p-2 text-base font-normal text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
        :class="{
          '': selectedCategoryId !== category.id,
          'border-l-4 border-blue-400 bg-gray-100 dark:bg-gray-700':
            selectedCategoryId === category.id,
        }"
        @click="filterByCategory(category.id)"
      >
        <div
          class="h-6 w-6 flex-shrink-0 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
          :class="{
            'text-black dark:text-white':
              selectedCategoryId === null || selectedCategoryId !== category.id,
            'text-white dark:text-white': selectedCategoryId === category.id,
          }"
        >
          <i :class="category.icon ? 'bi bi-' + category.icon : ''"></i>
        </div>
        <span
          class="ml-3"
          :class="{
            'text-black dark:text-white':
              selectedCategoryId === null || selectedCategoryId !== category.id,
            'text-white dark:text-white': selectedCategoryId === category.id,
          }"
          >{{ category.name }}</span
        >
      </li>
    </ul>
    <div class="block sm:hidden">
      <select
        id="category-select"
        class="block w-full p-2 mb-5 mt-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        :value="selectedCategoryId"
        @change="filterByCategory($event.target.value)"
      >
        <option value="">All</option>
        <option value="" disabled>Choose a category</option>
        <option
          v-for="(category, index) in categories"
          :key="index"
          :value="category.id"
          >{{ category.name }}</option
        >
      </select>
    </div>
  </div>
</template>

<script>
  export default {
    props: {
      categories: {
        type: Array,
        required: true,
      },
      selectedCategoryId: {
        type: Number,
        default: null,
      },
    },
    emits: ["update:selectedCategoryId"],
    methods: {
      resetCategoryFilter() {
        this.$emit("update:selectedCategoryId", null);
      },
      filterByCategory(value) {
        if (value === "") {
          this.resetCategoryFilter();
        } else {
          this.$emit("update:selectedCategoryId", Number(value));
        }
      },
    },
  };
</script>
