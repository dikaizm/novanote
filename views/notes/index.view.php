<?php require base_path('views/partials/notes/head.php'); ?>

<?php require base_path('views/partials/notes/nav.php'); ?>
<?php require base_path('views/partials/notes/sidebar.php'); ?>

<div class="p-3 sm:ml-64">
  <div class="p-3 mt-16 sm:mt-14">

    <!--- create note --->

    <div class="mb-6">
      <form method="POST" id="input-form">

        <div class="w-full border border-gray-200 rounded-lg bg-gray-50 border-gray-300">
          <div class="create-note px-4 pt-2 bg-white rounded-t-lg">
            <label for="title" class="sr-only"></label>
            <textarea id="create-note-title" name="title" rows="1" class="w-full px-0 py-1 text-gray-900 font-bold bg-white border-0 focus:ring-0 placeholder-gray-400 resize-none" placeholder="Title"></textarea>
          </div>
          <div class="px-4 bg-white rounded-t-lg">
            <label for="body" class="sr-only"></label>
            <textarea id="create-note-body" name="body" rows="3" class="w-full px-0 py-0 text-sm text-gray-900 bg-white border-0  focus:ring-0 placeholder-gray-400 resize-none max-h-[60vh]" placeholder="Write a note..."></textarea>
          </div>
          <div class="flex items-center justify-between px-3 py-2 border-t border-gray-300">
            <button id="note-create-btn" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 hover:bg-blue-800">
              Create a note
            </button>

            <p id="note-error" class="inline-flex justify-center text-xs text-red-500 rounded-lg"></p>

            <div class="flex pl-0 space-x-1 sm:pl-2">
              <button type="button" class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Attach file</span>
              </button>
              <button type="button" class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Set location</span>
              </button>
              <button type="button" class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Upload image</span>
              </button>
            </div>
          </div>
        </div>
      </form>
    </div>

    <!--- notes card --->
    <div id="notes-container" class="container relative columns-2 lg:columns-3 xl:columns-4">

      <?php if (empty($notes)) : ?>
        <div class="absolute inset-0 flex flex-col items-center justify-center h-[calc(100vh*0.58)]">
          <img class="flex items-center pointer-events-none opacity-30 w-24 sm:w-32 h-auto" src="images/empty-notes.svg">
          <p class="flex items-center text-gray-400 mt-2">You have not created any notes</p>
        </div>
      <?php endif ?>

      <?php foreach ($notes as $index => $note) : ?>

        <div class="rounded break-inside-avoid mb-4">
          <div id="note-card-<?= $index ?>" class="note-card w-full h-min max-h-96 flex flex-col justify-between bg-blue-300 rounded-lg pt-4 pb-3 px-4 hover:bg-blue-400 hover:transform hover:scale-[1.02] transition-transform">
            <div>
              <h4 class="text-ellipsis overflow-hidden line-clamp-2 font-bold mb-3 <?= htmlspecialchars_decode($note['title']) != null ? "text-gray-800" : "text-gray-800/50" ?>"><?= htmlspecialchars_decode($note['title']) != null ? htmlspecialchars_decode($note['title']) : "Untitled" ?></h4>
              <p class="text-gray-800 text-sm text-ellipsis overflow-hidden break-words line-clamp-6 md:line-clamp-[12]"><?= htmlspecialchars_decode($note['body']) ?></p>
            </div>

            <div id="note-attr-<?= $index ?>" class="note-attr flex items-center justify-between text-gray-800 mt-3 fade-out">
              <p class="text-xs"><?= htmlspecialchars(date('F j, Y', strtotime($note['date']))) ?></p>

              <a href="#<?= $note['id'] ?>">
                <button id="note-edit-btn-<?= $index ?>" data-id="<?= $note['id'] ?>" type="button" class="w-6 h-6 rounded-full bg-blue-700 text-white flex items-center justify-center hover:bg-blue-800 transition-transform" aria-label="edit note" role="button">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z"></path>
                    <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4"></path>
                    <line x1="13.5" y1="6.5" x2="17.5" y2="10.5"></line>
                  </svg>
                </button>
              </a>
            </div>

          </div>

        </div>
      <?php endforeach ?>
    </div>

  </div>
</div>

<!--- Edit note modal --->
<?php view('notes/edit.view.php') ?>

<?php require base_path('views/partials/notes/footer.php'); ?>