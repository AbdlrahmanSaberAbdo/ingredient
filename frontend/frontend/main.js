var page = 0;
var total_recipe_pages = 0;
var ingredients;
$(document).ready(function() {
    page =1 ;
    var data = {
        url: "http://127.0.0.1:8000/api/recipes?page="+page,
        method: 'get'
    }
    doAjax(data, {
        success: function(res) {
            var recipes = res.data
            page = res.meta.current_page
            if(page == 1) {
                $(".previous").css("display", "none")
            }
            total_recipe_pages = Math.ceil(res.meta.total/res.meta.per_page);
            console.log(total_recipe_pages)
            recipes.forEach(recipe => {
                
                $("table tbody").append(
                    `
                        <tr>
                            <td>${recipe.id}</td>
                            <td>${recipe.name}</td>
                            <td>${recipe.description}</td>
                            <td>
                                <button type="button" class="btn btn-success">View Ingredients</button>
                            </td>
                            <td>
                                 <button type="button" class="btn btn-warning">Edit</button>
                                 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#recipeModal">Create</button>
                            </td>
                        </tr>
                    `
                )
            });

        }
    })

    nextClick();
    previousClick();
})
function previousClick() {

    $(".previous").click(function() {
        page--;
        if(page < total_recipe_pages) {
            $(".next").css("display", "block")
        }
        var data = {
            url: "http://127.0.0.1:8000/api/recipes?page="+page,
            method: 'get'
        }
        doAjax(data, {
            success: function(res) {
                var recipes = res.data
                console.log(res.meta)
                if(page == 1) {
                    $(".previous").css("display", "none")
                }
                $("table tbody").html("");
                recipes.forEach(recipe => {
                    $("table tbody").append(
                        `
                            <tr>
                                <td>${recipe.id}</td>
                                <td>${recipe.name}</td>
                                <td>${recipe.description}</td>
                                <td>
                                    <button type="button" class="btn btn-success">View Ingredients</button>
                                </td>
                                <td>
                                     <button type="button" class="btn btn-warning">Edit</button>
                                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#recipeModal">Create</button>
                                </td>
                            </tr>
                        `
                    )
                });
    
            }
        })   
    })
}
function nextClick() {
    $(".next").click(function() {
        page++;
        if(page == 2) {
            $(".previous").css("display", "block")
        }
        var data = {
            url: "http://127.0.0.1:8000/api/recipes?page="+page,
            method: 'get'
        }
        doAjax(data, {
            success: function(res) {
                var recipes = res.data
                console.log(res.meta)
                if(page == total_recipe_pages) {
                    $(".next").css("display", "none")
                }
                $("table tbody").html("");
                recipes.forEach(recipe => {
                    $("table tbody").append(
                        `
                            <tr>
                                <td>${recipe.id}</td>
                                <td>${recipe.name}</td>
                                <td>${recipe.description}</td>
                                <td>
                                    <button type="button" class="btn btn-success">View Ingredients</button>
                                </td>
                                <td>
                                     <button type="button" class="btn btn-warning">Edit</button>
                                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#recipeModal">Create</button>
                                </td>
                            </tr>
                        `
                    )
                });
    
            }
        })     
    })
}
$(document).on("click",".createRecipeBtn",function(e) {
    console.log("clicked")
    e.preventDefault();
    var ingredientss = $(".ings").val();
    console.log( $(".ings"))
    var name = $("input[name='name']").val()
    var description = $("input[name='description']").val()
    var data = {
        name: name,
        description: description,
        ingredients: ingredients
    }
    console.log(ingredients)
})
$(".add_ingredients").click(function() {
    var ingredients_element = ""
    ingredients.forEach(value => {
        ingredients_element+=`<option value="${value.id}">${value.name}</option>`
    });
        $("#createRecipe").append(
            `
            <label for="ingredients">Select Ingredient</label>
                <select class="form-control" id="ingredients" name="ingredient" class="ings">
                    ${ingredients_element}
                </select>
            `
        )
})
/**
 * @desc it's a function to make an Ajax request, just path the required data
 * callback options(success, error)
 * @param data: it's a object that have the required data to make an Ajax call
     * method
     * url
     * data
 * @param status: for success/error response
 */
function doAjax(data, status) {
    $.ajax({
        method: data.method,
        url: data.url,
        data: data.method.toLowerCase() == 'post' ? data.data : '',
        success: function(res) {
            status.success(res);
        },
        error: function() {
            status.error();
        }
    })
}

function getIngredients() {
    var data = {
        url: "http://127.0.0.1:8000/api/ingredients",
        method: "get"
    }
    doAjax(data, {
        success: function(res) {
            ingredients = res.data
            console.log(ingredients)
            ingredients.forEach(ingredient => {
                
                $(".ms-parent .ms-drop ul").append(
                    `
                    <li class="ms-select-all">
                        <label>
                        <input type="checkbox" value="${ingredient.id}" data-name="selectAllingredients">
                        <span>${ingredient.name}</span>
                        </label>
                    </li>
                    `
                ) 
            });
        }
    }) 
}
getIngredients()