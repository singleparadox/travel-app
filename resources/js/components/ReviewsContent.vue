<template>
  <v-timeline align-top dense>
    <template v-if="reviews.length > 0">
      <v-timeline-item
        v-for="review in reviews"
        :key="review.id"
        small
      >
        <div>
          <div class="font-weight-normal">
            <strong>{{ review.from }}</strong> @ {{ review.f_created_at }}
          </div>
          <div>{{ review.text }}</div>
        </div>
      </v-timeline-item>
    </template>
    <template v-else>
      <v-timeline-item small>
        <div>
          <div class="font-weight-normal">
            <strong>No reviews yet</strong>
          </div>
        </div>
      </v-timeline-item>
    </template>
  </v-timeline>
</template>

<script>
export default {
  props: {
    reviews: {
      type: Array,
      required: true,
    },
  },
};
</script>

<style lang="scss" scoped>
</style>