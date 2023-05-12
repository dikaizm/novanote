<div 
  class="modal-container
        relative z-20 hidden" 
  aria-labelledby="modal-title" 
  role="dialog" 
  aria-modal="true">
  <!--
    Background backdrop, show/hide based on modal state.

    Entering: "ease-out duration-300"
      From: "opacity-0"
      To: "opacity-100"
    Leaving: "ease-in duration-200"
      From: "opacity-100"
      To: "opacity-0"
  -->
  <div 
    class="modal-backdrop
          fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity"></div>

  <div 
    class="modal-panel
          fixed inset-0 z-10 overflow-y-auto">
    <div class="flex min-h-full items-center justify-center p-4 text-center">
      <!--
        Modal panel, show/hide based on modal state.

        Entering: "ease-out duration-300"
          From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          To: "opacity-100 translate-y-0 sm:scale-100"
        Leaving: "ease-in duration-200"
          From: "opacity-100 translate-y-0 sm:scale-100"
          To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
      -->
      <div class="modal-panel
                  relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all my-8 w-full max-w-lg">
        <!--- create note --->      

<form method="POST" action="/notes">

  <input type="hidden" name="_method" value="PATCH">
  <input type="hidden" name="id" value="<?= $note['id'] ?>">

   <div class="w-full rounded-lg bg-gray-50">
      <div class="px-4 pt-2 bg-white rounded-t-lg">
            <label 
              for="title"
              class="sr-only"
            ><?= $_POST['title'] ?? '' ?></label>
            <textarea 
              id="title"
              name="title"
              rows="1" 
              class="w-full px-0 py-1 text-gray-900 font-bold bg-white border-0 focus:ring-0 placeholder-gray-400 resize-none" 
              placeholder="Title"></textarea>
      </div>
       <div class="px-4 bg-white rounded-t-lg">
           <label 
              for="body" 
              class="sr-only"
              ><?= $_POST['body'] ?? '' ?></label>
           <textarea 
              id="body" 
              name="body"
              rows="8" 
              class="w-full px-0 py-0 text-sm text-gray-900 bg-white border-0  focus:ring-0 placeholder-gray-400" 
              placeholder="Write a note..." 
              ></textarea>
       </div>
       <div class="flex items-center justify-between px-3 py-2 border-t border-gray-300">
        <div class="flex space-x-1">
           <button type="submit" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 hover:bg-blue-800"
           >Save note</button>
           <button 
            type="button" 
            class="modal-close
                  inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-gray-500 hover:text-gray-900"
            >Cancel</button>
        </div>
           <div class="flex">
            <?php if(isset($errorsEdit['body'])) : ?>
                  <p class="text-red-500 text-xs"><?= $errorsEdit['body'] ?></p>
            <?php endif; ?>
           </div>
           <div class="flex pl-0 space-x-1 sm:pl-2">
               <button type="button" class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100">
                   <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd"></path></svg>
                   <span class="sr-only">Attach file</span>
               </button>
               <button type="button" class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100">
                   <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                   <span class="sr-only">Set location</span>
               </button>
               <button type="button" class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100">
                   <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path></svg>
                   <span class="sr-only">Upload image</span>
               </button>
           </div>
       </div>
   </div>
</form>
      </div>
    </div>
  </div>
</div>
