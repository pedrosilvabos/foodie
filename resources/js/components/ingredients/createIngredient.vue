
<template>
  <div>
    <h1>Create ingredient</h1>
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
              <label for="ingredientName" class="control-label">Name</label>
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
              <div class="invalid-feedback">Please type a name for you ingredient.</div>
            </div>
            <div class="col-xs-4 form-group">
              <label for="ingredientType" class="control-label">Type</label>
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
            <div class="form-row">
              <div class="col-xs-4 form-group">
                <label class="control-label">Price per kg</label>
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
                <div class="invalid-feedback">Invalid price</div>
              </div>

              <div class="col-xs-4 form-group">
                <label class="control-label">Quantity Gr</label>
                <input
                  placeholder="ex: 6.00"
                  type="number"
                  step="any"
                  v-model="ingredient.quantity_gr"
                  class="form-control"
                  required
                  v-bind:class="{'form-control':true, 'is-invalid' : (ingredient.quantity_gr < 1), 'is-valid' : (ingredient.quantity_gr >= 1)}"
                />
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Invalid quantity</div>
              </div>
              </div>
              <div class="form-row">
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
                <div class="col-xs-4 form-group">
                  <label class="control-label">Ingredient Fat (grams)</label>
                  <input
                    placeholder="150"
                    type="number"
                    step="any"
                    v-model="ingredient.fat"
                    class="form-control"
                    required
                    v-bind:class="{'form-control':true, 'is-invalid' : (ingredient.fat < 1), 'is-valid' : (ingredient.fat >= 1)}"
                  />
                  <div class="valid-feedback">Looks good!</div>
                  <div class="invalid-feedback">Invalid quantity</div>
                </div>
                <div class="col-xs-4 form-group">
                  <label class="control-label">Ingredient Carbohydrates (grams)</label>
                  <input
                    placeholder="150"
                    type="number"
                    step="any"
                    v-model="ingredient.carbohydrates"
                    class="form-control"
                    required
                    v-bind:class="{'form-control':true, 'is-invalid' : (ingredient.carbohydrates < 1), 'is-valid' : (ingredient.carbohydrates >= 1)}"
                  />
                  <div class="valid-feedback">Looks good!</div>
                  <div class="invalid-feedback">Invalid quantity</div>
                </div>
              </div>
            </div>
 
          <div class="form-row">
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
              <div class="invalid-feedback">Invalid time span</div>
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
        fat:"",
        carbohydrates:"",
        price: "",
        quantity_gr: "",
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
            price: this.ingredient.price,
            quantity_gr: this.ingredient.quantity_gr,
            proteins: this.ingredient.proteins,
            fat: this.ingredient.fat,
            carbohydrates: this.ingredient.carbohydrates,
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