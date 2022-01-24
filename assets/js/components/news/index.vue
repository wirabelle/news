<template>
    <ul>
        <li v-if="loading">Chargement...</li>
        <li v-for="item in items">
            <a v-bind:href="item.link">{{ item.title }}</a>
        </li>
    </ul>
</template>

<script>
   export default {
        name: "news-index",
        props: ['endpoint', 'showUrl'],
        data() {
            return {
                items: []
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
                    this.items = response.data;

                    for(let key in this.items){
                        let item = this.items[key];
                        item.link = this.showUrl.replace('__id__', item.id);
                    }
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