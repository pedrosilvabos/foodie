<template>
  <div>
    <div class="container">
      <input type="text" v-model="search" placeholder="Find" />

      Save to pantry
      <select>
        <option
          v-for="(pantries) in pantry"
          :value="pantries.id"
        >{{ pantries }}</option>
      </select>

      <input
        type="button"
        class="fa fa-minus"
        aria-hidden="true"
        v-on:click="SaveToPantry()"
        value="save"
      />
      <div class="content"></div>
      <div class="row">
        <div class="col-md-12">
          <div v-for="ingredient in ingredients"></div>
          <div class="row">
            <div v-for="(pIngredient, index) in filteredIngredients">
              <div class="col-sm-4" style="padding:10px">
                <div class="card" style="width: 12rem; height: 10rem">
                  <img class="card-img-top" :src="GetImagePath(index)" alt="Card image cap" />
                  <div class="card-body">
                    <h5 class="card-title">{{ pIngredient.name }}</h5>
                    <input
                      placeholder="gr"
                      type="number"
                      v-model="ingredientQuantity"
                      min="9" max="6"
                    />
                    <input
                      type="button"
                      class="fa fa-plus"
                      aria-hidden="true"
                      v-on:click="AddIngredientToPantry(pIngredient)"
                      value="add"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="row">
            <div v-for="(ingredient, index) in pantryArray">
              {{ ingredient.name }}
              <input
                type="button"
                class="fa fa-minus"
                aria-hidden="true"
                v-on:click="RemoveIngredientFromPantry(index)"
                value="remove"
              />
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
  data() {
    return {
ingredientQuantity:"",
      ingredients: [],
      pantry: [],
      pantryId: [],
      search: "",
      pantryArray: [],
      userName: "",
      userId: ""
    };
  },
  created() {
    this.userName = this.user.name;
    this.userId = this.user.id;
    axios
      .get("../api/pantry/" + this.userId) // add user token
      .then(response => (this.pantry = response.data.id));
    axios
      .get("../api/ingredients") // add user token
      .then(response => (this.ingredients = response.data));
      if(this.userId == 0){
        this.pantry = [];
      }
  },
  computed: {
    filteredIngredients: function() {
      return this.ingredients.filter(ingredient => {
        return ingredient.name.toLowerCase().match(this.search.toLowerCase());
      });
    }
  },
  methods: {
    AddIngredientToPantry: function(ingredient) {
ingredient.quantity_gr = this.ingredientQuantity;
      this.pantryArray.push(ingredient);
      this.ClearCart();
      this.$emit('ingredientArray', ingredient )
    },
    RemoveIngredientFromPantry: function(index) {
      this.pantryArray.splice(index, 1);
    },
    ClearCart: function() {
      this.ingredient = {};
    },
    GetImagePath(index) {
      return this.ingredients[index].ingredient_icon;
    },
    SaveToPantry() {
      axios.put("../api/pantry/" + this.userId, {
        ingredient: this.pantryArray
      });
    }
  }
};
</script>
