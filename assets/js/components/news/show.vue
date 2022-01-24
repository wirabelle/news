<template>
    <div class="card w-100" style="width: 18rem;">
        <div class="card-body">
            <h2 class="card-title">{{ item.title }}</h2>
            <img v-bind:src="item.image">
            <p class="card-text">{{ item.description }}</p>
        </div>
    </div>

</template>

<script>
   export default {
        name: "news-show",
        props: ['endpoint'],
        data() {
            return {
                item: {},
            }
        },
        created() {
            this.getDataFromApi()
        },
        methods: {
            getDataFromApi() {
                this.loading = true

                this.axios.get(this.endpoint)
                .then(response => {
                    this.loading = false
                    this.item = response.data;
                })
                .catch(error => {
                    this.loading = false
                    console.log(error)
                })
            }
        }


   }
</script>

<style scoped>

</style>