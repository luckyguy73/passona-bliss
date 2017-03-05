<template>
    <form action="#" class="form">
        <div class="form-group">
            <input type="text" placeholder="Search listings by title, body, location, etc."
                id="listing-search" class="form-control" autocomplete="off">
        </div>
    </form>
</template>

<script>
    import { listingsautocomplete } from '../helpers/autocomplete.js'
    
    export default {
        props: [
            'categoryId',
            'areaIds'
        ],
        mounted () {
            listingsautocomplete('#listing-search', {
                categoryId: this.categoryId,
                areaIds: this.areaIds,
            })
        }
    }
</script>

