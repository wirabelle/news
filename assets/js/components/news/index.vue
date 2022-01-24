<template>
    <div class="list-group">
        <div v-if="loading">Chargement...</div>
        <a v-for="item in items"v-bind:href="item.link" aria-current="true"  class="news list-group-item list-group-item-action">
            <div class="row">
                <div class="col-3">
                    <img class="news-img" v-bind:src="item.image"/>
                </div>
                <div class="col-9">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ item.title }}</h5>
                        <small>{{ item.publishedAt }}</small>
                    </div>
                    <p class="mb-1">{{ item.description }}</p>
                </div>
            </div>
        </a>
    </div>
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