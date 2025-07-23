<?php
loadPartial("header");
loadPartial("nav");
loadPartial("showcase");
loadPartial("topbanner");
?>
<!-- Job Listings -->
<section>
  <div class="container mx-auto p-4 mt-4">
    <div class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3">Recent Jobs</div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
      <!-- Job Listing 1: Software Engineer -->

      <?php foreach ($listings as $listing): ?>

        <div class="rounded-lg shadow-md bg-white">
          <div class="p-4">
            <h2 class="text-xl font-semibold"><?= $listing->title ?></h2>
            <p class="text-gray-700 text-lg mt-2">
              <?= $listing->description ?>
            </p>
            <ul class="my-4 bg-gray-100 p-4 rounded">
              <li class="mb-2"><strong>Salary:</strong> <?= formatSalary($listing->salary) ?> </li>
              <li class="mb-2">
                <strong>Location:</strong><?= $listing->city ?>
                <span
                  class="text-xs bg-blue-500 text-white rounded-full px-2 py-1 ml-2">Local</span>
              </li>
              <li class="mb-2">
                <strong>Tags:</strong> <span><?= $listing->tags ?></span>,
                <span>Coding</span>
              </li>
            </ul>
            <a href="/listings/<?= $listing->id ?>"
              class="block w-full text-center px-5 py-2.5 shadow-sm rounded border text-base font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200">
              Details
            </a>
          </div>
        </div>

      <?php endforeach; ?>



    </div>
    <a href="/listings" class="block text-xl text-center">
      <i class="fa fa-arrow-alt-circle-right"></i>
      Show All Jobs
    </a>
</section>

<!-- Bottom Banner -->
<section class="container mx-auto my-6">
  <div
    class="bg-blue-800 text-white rounded p-4 flex items-center justify-between">
    <div>
      <h2 class="text-xl font-semibold">Looking to hire?</h2>
      <p class="text-gray-200 text-lg mt-2">
        Post your job listing now and find the perfect candidate.
      </p>
    </div>
    <a
      href="/listings/create"
      class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded hover:shadow-md transition duration-300">
      <i class="fa fa-edit"></i> Post a Job
    </a>
  </div>
</section>

<?php loadPartial("footer") ?>
