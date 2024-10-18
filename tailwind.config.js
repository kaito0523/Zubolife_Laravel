/** @type {import('tailwindcss').Config} */
module.default = {
  content: [
    './resources/views/recipe/recipeCreate.blade.php',
    './resources/views/recipe/recipeList.blade.php',
    './resources/views/recipe/recipeShow.blade.php',
    './resources/views/profile/index.blade.php',
    './resources/views/profile/edit.blade.php',
    './resources/views/profile/recipeEdit.blade.php',
    './resources/views/memo/memoList.blade.php',
    './resources/views/memo/memoShow.blade.php',
    './resources/views/memo/memoCreate.blade.php',
    './resources/views/layouts/app.blade.php',
    './resources/views/favorite/recipeFavorite.blade.php',
    './resources/views/auth/login.blade.php',
    './resources/views/auth/register.blade.php',
    './resources/views/layouts/recipe.blade.php',
    './resources/views/layouts/favorite.blade.php',
    './resources/views/layouts/memo.blade.php',
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/line-clamp'),
  ],
}

