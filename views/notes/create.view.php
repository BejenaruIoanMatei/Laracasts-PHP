<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/navbar.php') ?>
<?php require base_path('views/partials/banner.php') ?>


<main>
  <div class="mx-auto max-w-3xl px-4 py-6 sm:px-6 lg:px-8">
    <form method="POST">
      <div class="space-y-6">
        <div class="col-span-full">
          <!-- <label for="body" class="block text-sm font-medium text-gray-900">Note</label> -->
          <div class="mt-2">
            <textarea id="body" name="body" rows="6" placeholder="Write your note here..." 
              class="block w-full rounded-md bg-white px-3 py-2 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600 sm:text-sm"
              ><?= $_POST['body'] ?? '' ?></textarea>

              <?php if (isset($errors['body'])) : ?>
                <p class="text-red-500 text-xs mt-2"><?= $errors['body'] ?></p>
              <?php endif ?>
          </div>
        </div>
      </div>

      <div class="mt-6 flex items-center justify-end gap-x-4">
        <a href="/notes" class="text-sm font-semibold text-gray-900">Cancel</a>
        <button type="submit"
          class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-500 focus:outline-2 focus:outline-indigo-600">
          Create
        </button>
      </div>
    </form>
  </div>
</main>


<?php require base_path('views/partials/footer.php') ?>
