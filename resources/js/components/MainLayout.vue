<template>
  <v-container fluid class="ma-0 pa-0">
    <v-row justify="center">
      <v-col :cols="cols">
        <travel-app></travel-app>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import TravelApp from "./TravelApp.vue";

export default {
  components: {
    "travel-app": TravelApp,
  },
  computed: {
    breakpoint() {
      return this.$vuetify.breakpoint.name;
    },
    cols() {
      if (this.breakpoint === "xs") {
        return "12";
      }
      if (this.breakpoint === "sm") {
        return "12";
      }
      if (this.breakpoint === "lg") {
        return "6";
      }
      if (this.breakpoint === "xl") {
        return "4";
      }

      return "8";
    },
  },
};
</script>