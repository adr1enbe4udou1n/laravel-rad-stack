<template>
  <div v-if="pages.length > 1">
    <div class="flex flex-wrap justify-center -mb-1">
      <button
        type="button"
        class="link"
        :disabled="currentPage === 1"
        @click="changePage(1)"
      >
        <chevron-double-left-icon />
      </button>
      <button
        type="button"
        class="link"
        :disabled="currentPage === 1"
        @click="changePage(currentPage - 1)"
      >
        <chevron-left-icon />
      </button>
      <button
        v-for="(page, i) in pages"
        :key="i"
        type="button"
        class="link"
        :disabled="page === currentPage"
        :class="{ active: page === currentPage }"
        @click="changePage(page)"
      >
        {{ page }}
      </button>
      <button
        type="button"
        class="link"
        :disabled="currentPage === lastPage"
        @click="changePage(currentPage + 1)"
      >
        <chevron-right-icon />
      </button>
      <button
        type="button"
        class="link"
        :disabled="currentPage === lastPage"
        @click="changePage(lastPage)"
      >
        <chevron-double-right-icon />
      </button>
    </div>
  </div>
</template>

<script lang="ts">
  import { computed, defineComponent } from 'vue'

  export default defineComponent({
    props: {
      currentPage: {
        type: Number,
        required: true,
      },
      perPage: {
        type: [Number, String],
        required: true,
      },
      total: {
        type: Number,
        required: true,
      },
    },
    emits: ['change'],
    setup(props, { emit }) {
      const lastPage = computed(() => {
        let page = props.perPage
        if (typeof page === 'string') {
          page = parseInt(page, 10)
        }
        return Math.ceil(props.total / page)
      })

      const pages = computed(() =>
        [...Array(Math.ceil(lastPage.value)).keys()].map((x) => ++x)
      )

      const changePage = (page: number) => {
        emit('change', page)
      }

      return {
        lastPage,
        pages,
        changePage,
      }
    },
  })
</script>

<style lang="postcss" scoped>
  .link {
    @apply mr-1 mb-1 px-4 py-3 text-sm leading-4 border border-primary-300 rounded;

    svg {
      @apply h-4 w-4;
    }

    &[disabled] {
      @apply cursor-not-allowed;

      &:not(.active) {
        @apply opacity-25;
      }
    }

    &:not([disabled]) {
      @apply hover:bg-white focus:border-primary-500 focus:text-primary-500;
    }

    &.active {
      @apply bg-primary text-white;
    }
  }
</style>
