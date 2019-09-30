
<template>
  <div>
    <h1>Create ingredient</h1>
    <div class="panel panel-default">
      <div class="panel-heading">
        Create new company
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
              <label for="ingredientName" class="control-label">Ingredient name</label>
              <input
                type="text"
                id="ingredientName"
                v-model="ingredient.name"
                placeholder="ex: Potato"
                v-bind:class="{'form-control':true, 'is-invalid' : (ingredient.name ==''), 'is-valid' : (ingredient.name !='')}"
                class="form-control"
                required
              />
              <div class="valid-feedback">Looks good!</div>
              <div class="invalid-feedback">Please a name for you ingredient.</div>
            </div>
            <div class="col-xs-4 form-group">
              <label for="ingredientType" class="control-label">Ingredient Type</label>
              <select
                id="ingredientType"
                v-model="ingredient.type"
                class="dropdown form-control"
                v-bind:class="{'form-control':true, 'is-invalid' : (ingredient.type ==''), 'is-valid' : (ingredient.type !='')}"
                required
              >
                <option value selected disabled hidden>Choose here</option>
                <option v-for="type in types" v-bind:key="ingredient.type">{{type}}</option>
              </select>
            </div>

            <div class="col-xs-4 form-group">
              <label class="control-label">Ingredient serving</label>
              <input
                placeholder="ex: 15"
                type="number"
                v-model="ingredient.servings"
                v-bind:class="{'form-control':true, 'is-invalid' : (ingredient.servings < 1), 'is-valid' : (ingredient.servings >= 1)}"
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
                v-model="ingredient.price"
                class="form-control"
                required
                v-bind:class="{'form-control':true, 'is-invalid' : (ingredient.price < 1), 'is-valid' : (ingredient.price >= 1)}"
              />
              <div class="valid-feedback">Looks good!</div>
              <div class="invalid-feedback">Invalid quantity</div>
            </div>

            <div class="col-xs-4 form-group">
              <label class="control-label">Ingredient quantity Kg</label>
              <input
                placeholder="ex: 6.00"
                type="number"
                step="any"
                v-model="ingredient.quantity_kg"
                class="form-control"
                required
                v-bind:class="{'form-control':true, 'is-invalid' : (ingredient.quantity_kg < 1), 'is-valid' : (ingredient.quantity_kg >= 1)}"
              />
              <div class="valid-feedback">Looks good!</div>
              <div class="invalid-feedback">Invalid quantity</div>
            </div>

            <div class="col-xs-4 form-group">
              <label class="control-label">Ingredient Protein (grams)</label>
              <input
                placeholder="150"
                type="number"
                step="any"
                v-model="ingredient.proteins"
                class="form-control"
                required
                v-bind:class="{'form-control':true, 'is-invalid' : (ingredient.proteins < 1), 'is-valid' : (ingredient.proteins >= 1)}"
              />
              <div class="valid-feedback">Looks good!</div>
              <div class="invalid-feedback">Invalid quantity</div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-xs-4 form-group">
              <label class="control-label">Ingredient Calories</label>
              <input
              placeholder="80"
                type="number"
                step="any"
                v-model="ingredient.calories"
                class="form-control"
                required
                  v-bind:class="{'form-control':true, 'is-invalid' : (ingredient.calories < 1), 'is-valid' : (ingredient.calories >= 1)}"
              />
              <div class="valid-feedback">Looks good!</div>
              <div class="invalid-feedback">Invalid quantity</div>
            </div>

            <div class="col-xs-4 form-group">
              <label class="control-label">Ingredient lifetime (days)</label>
              <input
              placeholder="5"
                type="number"
                step="any"
                v-model="ingredient.lifetime"
                class="form-control"
                required                
                v-bind:class="{'form-control':true, 'is-invalid' : (ingredient.lifetime < 1), 'is-valid' : (ingredient.lifetime >= 1)}"
              />
              <div class="valid-feedback">Looks good!</div>
              <div class="invalid-feedback">Invalid quantity</div>
            </div>

            <div class="col-xs-4 form-group">
              <label class="control-label">Ingredient icon</label>
              <input type="text" v-model="ingredient.icon" class="form-control" />
            </div>
          </div>

          <button class="btn btn-primary" @click.prevent="saveForm()" id="name" name="name">
            <span class="glyphicon glyphicon-plus"></span> ADD
          </button>

          <!-- Icon can be one of: "success", "warning", "info", "error" and "loading" -->
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      status: "",
      types: ["vegetable", "main", "dessert"],

      ingredient: {
        name: "",
        type: "",
        servings: "",
        price: "",
        quantity_kg: "",
        proteins: "",
        calories: "",
        lifetime: "",
        icon: ""
      }
    };
  },
  mounted: function() {
    console.log("Component Loaded...");
  },
  methods: {
    saveForm: function() {
      axios
        .post("../api/ingredients", null, {
          params: {
            name: this.ingredient.name,
            type: this.ingredient.type,
            servings: this.ingredient.servings,
            price: this.ingredient.price,
            quantity_kg: this.ingredient.quantity_kg,
            proteins: this.ingredient.proteins,
            calories: this.ingredient.calories,
            lifetime: this.ingredient.lifetime,
            icon: this.ingredient.icon
          }
        }) // add user token
        .then(response => {
          if (response.status === 200) {
            response => (this.ingredients = response.data),
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
    }
  }
};
</script>