
<template>
  <div>
    <h1>Create Recipe</h1>
    <div class="panel panel-default">
      <div class="panel-heading">
          
        <div id="status" style="position: absolute; left: 26%;top: 7%;">
          <sweetalert-icon v-if="status == 200" icon="success" />
          <sweetalert-icon v-if="499 < status > 300" icon="warning" />
          <sweetalert-icon v-if="status == 500" icon="error" />
        </div>
      </div>
      <form>
        <div class="panel-body">
          <div class="form-row">
            <div class="col-xs-4 form-group">
              <label for="ingredientName" class="control-label">Recipe name</label>
              <input
                type="text"
                id="ingredientName"
                v-model="recipe.recipes_name"
                placeholder="ex: Potato"
                v-bind:class="{'form-control':true, 'is-invalid' : (recipe.recipes_name ==''), 'is-valid' : (recipe.recipes_name !='')}"
                class="form-control"
                required
              />
              <div class="valid-feedback">Looks good!</div>
              <div class="invalid-feedback">Please a name for you recipe.</div>
            </div>
            <div class="col-xs-4 form-group">
              <label for="recipeType" class="control-label">Recipe Type</label>
              <select
                id="recipeType"
                v-model="selectedRecipes_type"
                class="dropdown form-control"
                v-bind:class="{'form-control':true, 'is-invalid' : (selectedRecipes_type ==''), 'is-valid' : (selectedRecipes_type !='')}"
                required
              >
            
                <option v-for="type in recipe.recipes_type">{{type}}</option>
              </select>

            </div>

            <div class="col-xs-4 form-group">
              <label class="control-label">Ingredient serving</label>
              <input
                placeholder="ex: 3"
                type="number"
                v-model="recipe.recipes_cost"
                v-bind:class="{'form-control':true, 'is-invalid' : (recipe.recipes_cost < 1), 'is-valid' : (recipe.recipes_cost >= 1)}"
              />
              <div class="valid-feedback">Looks good!</div>
              <div class="invalid-feedback">Invalid quantity</div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-xs-4 form-group">
              <label class="control-label">Ingredient price</label>
              <input
                placeholder="ex: 10.00"
                type="number"
                step="any"
                v-model="recipe.recipes_discription"
                class="form-control"
                required
                v-bind:class="{'form-control':true, 'is-invalid' : (recipe.recipes_discription < 1), 'is-valid' : (recipe.recipes_discription >= 1)}"
              />
              <div class="valid-feedback">Looks good!</div>
              <div class="invalid-feedback">Invalid quantity</div>
            </div>

            <div class="col-xs-4 form-group">
              <label class="control-label">Recipe description</label>
              <input
                placeholder="ex: 6.00"
                type="number"
                step="any"
                v-model="recipe.recipes_protein"
                class="form-control"
                required
                v-bind:class="{'form-control':true, 'is-invalid' : (recipe.recipes_protein < 1), 'is-valid' : (recipe.recipes_protein >= 1)}"
              />
              <div class="valid-feedback">Looks good!</div>
              <div class="invalid-feedback">Invalid quantity</div>
            </div>
            <!--Calories are calculater per weight so we need to do this mat here -->
            <div>{{calories}} - {{proteins}}</div>
            <div></div>

            <div v-for="ingredients in selectedIngredients">
              <div>{{ingredients.name}}</div>
              
            </div>
            
          </div>
          
          <button class="btn btn-primary" @click.prevent="saveForm()" id="name" name="name">
            <span class="glyphicon glyphicon-plus"></span> ADD
          </button>
          
          
        <ingredientlist :user=user v-on:ingredientArray="udpateArray($event)"></ingredientlist>
          <!-- Icon can be one of: "success", "warning", "info", "error" and "loading" -->
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
     props: ["user"],
  data() {
    return {
      status: "",
      selectedRecipes_type:"",
      selectedIngredients: [],
      selectedIngredientsId:[],
      selectedIngredientQuantity:[],
      calories:0,
      proteins:0,
        recipe: {
        recipes_name: "",
        recipes_type: ["Breakfast","Lunch","Dinner","Snack","Dessert"],
        recipes_cost: "",
        recipes_discription: "",
        recipes_protein: "",
        created_at: "",
        updated_at: "",
        ingredients: [],
      }
    };
  },
  mounted: function() {
    console.log("Recipe Creator Component Loaded...");
  },
  methods: {
    saveForm: function() {
      axios
        .post("../api/recipes", null, {
          params: {

        recipes_name: this.recipe.recipes_name,
        recipes_type: this.selectedRecipes_type,
        recipes_cost: this.recipe.recipes_cost,
        recipes_discription: this.recipe.recipes_discription,
        recipes_protein: this.recipe.recipes_protein,
        ingredients: this.selectedIngredientsId,
        quantity:this.selectedIngredientQuantity


          }
        }) // add user token
        .then(response => {
          if (response.status === 200) {
            response => (this.recipe = response.data),
              (this.status = "200");
            setTimeout(function() {
              document.getElementById("status").style.display = "none";
            }, 3000);
          } else {
            // throw error and go to catch
            throw new Error("Error");
          }
        })
        .catch(error => {
          //when throw "Error" is executed it runs the catch block code
          this.status = "500";
          setTimeout(function() {
            document.getElementById("status").style.display = "none";
          }, 3000);
        });
    },
    updateContact: function(id) {
      console.log(this.contact);
      console.log("Updating contact " + id + "...");
      return;
    },
    countDownChanged(dismissCountDown) {
      this.dismissCountDown = dismissCountDown;
    },
    showAlert() {
      this.dismissCountDown = this.dismissSecs;
    },
    udpateArray(ingredientsForRecipe)
    {

      this.selectedIngredientQuantity.push(ingredientsForRecipe.quantity_gr);
      //clear out the array so you dont overlap it, this should be fixed ASAP!
   
this.selectedIngredients.push(ingredientsForRecipe);

 this.selectedIngredientsId = [];
for(var i=0; i<this.selectedIngredients.length;i++){
 
  this.selectedIngredientsId.push(this.selectedIngredients[i].id)
  this.calories += this.selectedIngredients[i].calories
  this.proteins += this.selectedIngredients[i].proteins
}

    }
  }
};
</script>