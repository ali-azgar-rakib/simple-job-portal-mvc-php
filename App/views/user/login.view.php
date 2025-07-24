<?php
loadPartial("header");
loadPartial("nav");
loadPartial("showcase");
loadPartial("topbanner");
?>

<!-- Login Form Box -->
<div class="flex justify-center items-center mt-20">
  <div class="bg-white p-8 rounded-lg shadow-md w-full md:w-500 mx-6">
    <h2 class="text-4xl text-center font-bold mb-4">Login</h2>
    <?php loadPartial('error', ['errors' => $errors ?? []]); ?>
    <form method="post" action="/auth/login">
      <div class="mb-4">
        <input
          type="email"
          name="email"
          placeholder="Email Address"
          value="<?= $user->email ?? '' ?>"
          class="w-full px-4 py-2 border rounded focus:outline-none" />
      </div>
      <div class="mb-4">
        <input
          type="password"
          name="password"
          value="<?= $user->password ?? '' ?>"
          placeholder="Password"
          class="w-full px-4 py-2 border rounded focus:outline-none" />
      </div>
      <button
        type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded focus:outline-none">
        Login
      </button>

      <p class="mt-4 text-gray-500">
        Don't have an account?
        <a class="text-blue-900" href="/auth/register">Register</a>
      </p>
    </form>
  </div>
</div>


<?php loadPartial('footer'); ?>
