<template>
<div>
    <input type="text" v-model="search" placeholder="Find">
    <div class="content">
        <div class="container">
            <div class="row">
                    <div v-for="ingredient in ingredients"></div>
                <div class="col">
                    <div v-for="(pIngredient, index) in filteredIngredients"> 
                    {{ pIngredient.name }} 
                   <img :src=GetImagePath(index)>
                   <input type="button" class="fa fa-plus" aria-hidden="true" v-on:click="AddIngredientToPantry(pIngredient)" value="add">
                    </div>
                </div>
                <div class="col">
                    <div v-for="(ingredient, index) in pantry"> 
                        {{ ingredient.name }} 
                        
                       <input type="button" class="fa fa-minus" aria-hidden="true" v-on:click="RemoveIngredientFromPantry(index)" value="remove">
                    </div>
                </div>
                <input type="button" class="fa fa-minus" aria-hidden="true" v-on:click="SaveToPantry()" value="save">
            </div>
        </div>
    </div>
</div> 
</template>

<script>
    export default {
        data(){
            return {
                ingredients : [],
                pantry: [],
                search:'',
            }

        },
        created() {
            axios.get('../api/ingredients') // add user token
            .then(response => this.ingredients = response.data)

        },
        computed: {
            filteredIngredients: function(){
               
                return this.ingredients.filter((ingredient) => {
                    return ingredient.name.toLowerCase().match(this.search.toLowerCase());
                });
            }
        },
        methods: {
            AddIngredientToPantry: function(ingredient){
                this.pantry.push(ingredient)
                this.ClearCart();
            },
            RemoveIngredientFromPantry: function(index){
                this.pantry.splice(index,1);
            },
            ClearCart: function(){
                this.ingredient = {}
            },
            GetImagePath(index){
           
                return this.ingredients[index].ingredient_icon;
            },
            SaveToPantry(){
                
                    axios.put('../api/pantry/1', { //hard coded pantry id
                    ingredient: this.pantry,

                })

            }
        },
        
    }
</script>

<style>


</style>