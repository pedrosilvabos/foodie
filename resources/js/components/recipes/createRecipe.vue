<template>
<div id="#apps">
    <input type="text" v-model="search" placeholder="Find">
    <div class="content">
        <div class="container">
            <input v-model="message" placeholder="edit me">
            {{wroteMessage}}
        </div>
    </div>
</div> 
</template>

<script>
    export default {
        data(){
            return {
                recipes : [],
                wroteMessage: message,
                search:'',
            }

        },
        created() {
            axios.get('../api/recipes') // add user token
            .then(response => this.recipes = response.data)

        },
        computed: {
            filteredRecipes: function(){
             
                return this.recipes.filter((recipe) => {
                    return recipe.recipes_name.toLowerCase().match(this.search.toLowerCase());
                });
            }
        },
        methods: {
            ShowRecipe: function(recipe){
                 axios.get('../api/recipes/' + recipe.id) // add user token
            .then(response => this.recipeDescription = response.data)

                
              
             
            },
            RemoverecipeFromPantry: function(index){
                this.pantry.splice(index,1);
            },
            ClearCart: function(){
                this.recipe = {}
            },
            GetImagePath(index){         
                return this.recipes[index].recipe_icon;
            },
            GetIngredients(id){
                 axios.get('../api/recipes') // add user token
            .then(response => this.recipes = response.data)


            }
        },
        
    }
</script>

<style>


</style>