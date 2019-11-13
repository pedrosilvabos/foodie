<template>
<div id="#apps">
    <input type="text" v-model="search" placeholder="Find">
    <div class="content">
        <div class="container">
            <div class="row" id="#app">
              
                <div class="col-3">
                    <div v-for="(precipe, index) in filteredRecipes" :key="(precipe, index)"> 
                        {{ precipe.recipes_name }} 
                        <input type="button" class="fa fa-plus" aria-hidden="true" v-on:click="ShowRecipe(precipe,recipeDescription,action='add')" value="add">
                        <input type="button" class="fa fa-plus" aria-hidden="true" v-on:click="ShowRecipe(precipe,recipeDescription,action='show')" value="details">
                        <input type="button" class="fa fa-plus" aria-hidden="true" v-on:click="ShowRecipe(precipe,recipeDescription,action='remove')" value="remove">
                   
                   
                    </div>
                </div>
                <div class="col-3">
                    all the ingredients the use has
                    <div v-for="userIngredient in pantry" :key="userIngredient.id">
                        {{ userIngredient.id }} - {{ userIngredient.name }}
                    </div>
                </div>
                 <div class="col-2">     
                    needed ingredients you need to buy
                        <div v-for="(userIngredient) in cart" :key="userIngredient.id">
                         
                            {{userIngredient}}
                    </div>
                </div>
                <div class="col-2">     
                    needed ingredients you need to make recipe
                     <div v-for="(neededIngredient) in recipeDescription" :key="neededIngredient.id">  
                        {{ neededIngredient.id }} - {{neededIngredient.name}}
                    </div>
                </div>
                 
                <div class="col-2">     
                    all the ingredients in the library
                    <div v-for="ingredient in ingredients" :key="ingredient.id">
                        {{ingredient.id}} - {{ ingredient.name }}
                    </div>
                </div>
                </div>
               
            </div>
        </div>
    </div>

</template>

<script>
    export default {
         props: ["user"],
        data(){
            return {
                recipes : [],
                recipeDescription: [],
                search:'',
                ingredients: [],
                pantry: [],
                userIngredients: [],
                pantryIngredients:[],
                recipeIngredients:[],

                cart:[],
               
            }

        },
        created() {
      
        this.userId = this.user.id;
        axios
        .get("../api/pantry/" + this.userId) // add user token
        .then(response => (this.pantry = response.data.ingredients));
        axios
        .get("../api/ingredients") // add user token
        .then(response => (this.ingredients = response.data));
       
        if(this.userId == 0){
            this.pantry = [];
        }
            axios.get('../api/recipes') // add user token
            .then(response => this.recipes = response.data)

        },
       
        computed: {
            filteredRecipes: function(){

         this.recipeIngredients = [];
         this.pantryIngredients = [];
                if(this.recipeDescription.length != 0){
                    var i = 0;
                    var j = 0;
                    var k = 0;
                    
                    for (i;i<this.recipeDescription.length;i++){
                    this.recipeIngredients.push(this.recipeDescription[i])
                    }
                    for(j;j<this.pantry.length;j++){
                        this.pantryIngredients.push(this.pantry[j].name);
                    }
                   
                for(k;k<this.recipeIngredients.length;k++)

              
             if(this.pantryIngredients.includes(this.recipeIngredients[k].name) != true){
                 
                 this.cart.push(this.recipeIngredients[k].name)
                 console.log('pushed')
             }
                   
                 }
                 
                return this.recipes.filter((recipe) => {
                    return recipe.recipes_name.toLowerCase().match(this.search.toLowerCase());
                });
            }
        },
        methods: {
            ShowRecipe: function(recipe,recipeDescription){
            axios.get('../api/recipes/' + recipe.id) // add user token
            .then(response => this.recipeDescription = response.data.ingredients)
         
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
           
        },
        
    }
</script>

<style>


</style>