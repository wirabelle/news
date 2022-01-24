<template>
    <div>
        <h2>{{ item.title }}</h2>
        <p>
            {{ item.description }}
        </p>
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