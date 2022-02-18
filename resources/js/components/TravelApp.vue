<template>
  <v-container fluid>
    <!-- Reviews Loader -->
    <v-dialog v-model="reviewsLoading" persistent max-width="500px">
      <v-card>
        <v-card-title class="headline text-center"
          >Loading Reviews</v-card-title
        >
        <v-card-text>
          <v-progress-linear indeterminate color="blue"></v-progress-linear>
        </v-card-text>
      </v-card>
    </v-dialog>

    <!-- Reviews Dialog -->
    <v-dialog v-model="reviewsDialog" max-width="500px">
      <v-card>
        <v-card-title>
          <span class="headline">Popular Reviews</span>
        </v-card-title>

        <v-card-text>
          <reviews-content :reviews="reviews"></reviews-content>
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="reviewsDialog = false"
            >Close</v-btn
          >
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- Main Sheet -->
    <v-sheet color="white" flat>
      <v-card flat :loading="loading">
        <v-card-title>
          <span class="title">{{ title }}</span>
          <span class="temperature" v-if="weather && weather.current"
            >{{ weather.current.temp.toFixed(1) }}° C
          </span>

          <template v-if="weather && weather.current">
            <template v-if="weather.current.weather.length > 0">
              <v-img
                :src="`http://openweathermap.org/img/wn/${weather.current.weather[0].icon}@2x.png`"
                class="weather-icon"
                contain
                height="80"
                width="80"
              ></v-img>
            </template>
          </template>
        </v-card-title>

        <v-card-subtitle class="d-flex flex-row justify-space-between">
          <template v-if="weatherLoading">
            <v-skeleton-loader type="text"></v-skeleton-loader>
          </template>
          <template v-else>
            <template v-if="weather && !weatherLoading">
              <span>{{ weather.timezone }}</span>
            </template>
            <template v-else>
              <span>&nbsp;</span>
            </template>

            <span v-if="weather && weather.current" class="text-capitalize">
              <template v-if="weather.current.weather.length > 0">
                {{ weather.current.weather[0].description }}
              </template>
            </span>
          </template>
        </v-card-subtitle>

        <v-divider></v-divider>

        <v-container class="d-flex flex-wrap justify-space-around">
          <v-btn :disabled="loading" text small @click="selectPlace('tokyo')">Tokyo</v-btn>
          <v-btn :disabled="loading" text small @click="selectPlace('yokohama')">Yokohama</v-btn>
          <v-btn :disabled="loading" text small @click="selectPlace('kyoto')">Kyoto</v-btn>
          <v-btn :disabled="loading" text small @click="selectPlace('osaka')">Osaka</v-btn>
          <v-btn :disabled="loading" text small @click="selectPlace('sapporo')">Sapporo</v-btn>
          <v-btn :disabled="loading" text small @click="selectPlace('nagoya')">Nagoya</v-btn>
        </v-container>

        <v-divider></v-divider>

        <template v-if="nearby">
          <template v-for="(item, key) in nearby">
            <v-card class="ma-2" outlined :key="item.fsqid">
              <v-card-title>
                <span> {{ key + 1 }}. {{ item.name }} </span>
              </v-card-title>
              <v-card-subtitle>
                <template v-for="(category, categoryIndex) in item.categories">
                  <span :key="category.id"
                    >{{ category.name }}
                    <span
                      v-if="
                        item.categories.length > 1 &&
                        categoryIndex !== item.categories.length - 1
                      "
                      >,
                    </span>
                  </span>
                </template>
              </v-card-subtitle>

              <!-- Image -->
              <template v-if="item.image">
                <v-img :src="item.image">
                  <template #placeholder>
                    <v-row
                      class="fill-height ma-0"
                      align="center"
                      justify="center"
                    >
                      <v-progress-circular
                        indeterminate
                        color="grey lighten-5"
                      ></v-progress-circular>
                    </v-row>
                  </template>
                </v-img>
              </template>
              <template v-else>
                <v-container fluid class="no-image d-flex justify-center">
                  <v-img src="/img/undraw_No_data_re_kwbl.png" contain>
                    <template #placeholder>
                      <v-row
                        class="fill-height ma-0"
                        align="center"
                        justify="center"
                      >
                        <v-progress-circular
                          indeterminate
                          color="grey lighten-5"
                        ></v-progress-circular>
                      </v-row>
                    </template>
                  </v-img>
                </v-container>
              </template>

              <v-card-text>
                <span>{{ item.location.formatted_address }}</span>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                  text
                  small
                  @click="
                    goToLocation(
                      item.geocodes.main.latitude,
                      item.geocodes.main.longitude
                    )
                  "
                  color="blue"
                >
                  View on Map
                  <v-icon small>mdi-map-marker</v-icon>
                </v-btn>
                <v-btn
                  text
                  small
                  @click="openReviews(item.fsq_id)"
                  color="blue"
                >
                  Reviews
                  <v-icon small>mdi-comment</v-icon>
                </v-btn>
              </v-card-actions>
            </v-card>
          </template>
        </template>
      </v-card>
    </v-sheet>
  </v-container>
</template>

<script>
import ReviewsContent from "./ReviewsContent.vue";

export default {
  components: {
    "reviews-content": ReviewsContent,
  },
  data() {
    return {
      selectedPlace: "tokyo",

      nearby: [],
      reviews: [],

      weather: {},

      reviewsDialog: false,

      reviewsLoading: false,
      weatherLoading: false,
      loading: false,
    };
  },
  computed: {
    title() {
      if (this.selectedPlace === "tokyo") {
        return "Tokyo, Japan";
      }
      if (this.selectedPlace === "yokohama") {
        return "Yokohama, Japan";
      }
      if (this.selectedPlace === "kyoto") {
        return "Kyoto, Japan";
      }
      if (this.selectedPlace === "osaka") {
        return "Osaka, Japan";
      }
      if (this.selectedPlace === "sapporo") {
        return "Sapporo, Japan";
      }
      if (this.selectedPlace === "nagoya") {
        return "Nagoya, Japan";
      }
    },
  },
  methods: {
    async fetchPlace() {
      this.loading = true;
      return axios
        .get("/api/places/" + this.selectedPlace)
        .then((response) => {
          this.nearby = response.data;
          this.fetchWeather();
        })
        .finally(() => {
          this.loading = false;
        });
    },
    async fetchWeather() {
      this.weatherLoading = true;
      return axios
        .get("/api/weather/" + this.selectedPlace)
        .then((response) => {
          this.weather = response.data;
        })
        .finally(() => {
          this.weatherLoading = false;
        });
    },
    async openReviews(fsq_id) {
      this.reviewsLoading = true;
      return await axios
        .get("/api/places/reviews/" + fsq_id)
        .then((res) => {
          if (res.data) {
            this.reviews = res.data;
            this.reviewsDialog = true;
          }
        })
        .finally(() => {
          this.reviewsLoading = false;
        });
    },
    selectPlace(place) {
      this.selectedPlace = place;
      this.fetchPlace(place);
    },
    goToLocation(lat, long) {
      window.open(
        "https://www.google.com/maps/search/?api=1&query=" + lat + "," + long,
        "_blank"
      );
    },
  },
  created() {
    this.fetchPlace();
  },
};
</script>

<style lang="scss" scoped>
.temperature {
  font-size: 25pt;
  position: absolute;
  right: 12px;
  top: 20px;
  float: right;
}
.weather-icon {
  position: absolute;
  right: 115px;
  top: -5px;
  float: right;
}
.no-image {
  height: 500px;
}
</style>