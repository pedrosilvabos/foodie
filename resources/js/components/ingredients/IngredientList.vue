<template>
<div>
    <input type="text" v-model="search" placeholder="Find">
    <div class="content">
        <div class="container">
            <div class="row">
             
                    <div v-for="ingredient in ingredients"></div>
                
                <div class="col">
                    <div v-for="(pIngredient, index) in filteredIngredients"> 
                    {{ pIngredient.ingredient_name }} 
                   <img :src=getImagePath(index)>
                     
                   <input type="button" class="fa fa-plus" aria-hidden="true" v-on:click="addIngredientToPantry(pIngredient)" value="add">
                    </div>
                </div>
                <div class="col">
                    <div v-for="(ingredient, index) in pantry"> 
                        {{ ingredient.ingredient_name }} 
                        
                       <input type="button" class="fa fa-minus" aria-hidden="true" v-on:click="removeIngredientFromPantry(index)" value="remove">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
</template>

<script>
    export default {
        data(){
            return {
                ingredients : {},
                pantry: [],
                search:'',
            }

        },
        created() {
            axios.get('../api/ingredients')
            .then(response => this.ingredients = response.data)
            
        },
        computed: {
            filteredIngredients: function(){
               
                return this.ingredients.filter((ingredient) => {
                    return ingredient.ingredient_name.toLowerCase().match(this.search.toLowerCase());
                });
            }
        },
        methods: {
            addIngredientToPantry: function(ingredient){
                this.pantry.push(ingredient)
                this.clearCart();
            },
            removeIngredientFromPantry: function(index){
                this.pantry.splice(index,1);
            },
            clearCart: function(){
                this.ingredient = {}
            },
            getImagePath(index){
           
                return this.ingredients[index].ingredient_icon;
            }
        },
        
    }
</script>

<style>


</style>