<div id="confirmModal" class="modal" style="
position: fixed;  /* Ensures modal stays in place */
    top: 25%;           /* Places the modal on top of the page */
    left: 30%;          /* Places the modal on the left edge of the page */
  width: 100%;      /* Optional: Stretches the modal to cover the entire width */
  height: 100%;     /* Optional: Stretches the modal to cover the entire height */
  z-index: 9999;    /* Places the modal on top of other elements */
  display: none;

">
    <div class="modal-content bg-white p-4 rounded-lg shadow-md">
        <span class="close absolute top-0 right-0 px-3 py-2 bg-red-500">x</span>
        <p class="text-lg font-semibold mb-4">Are you sure you want to delete this product?</p>
        <div class="flex justify-end">
            <button id="confirmDelete" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Yes</button>
            <button class="close bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded ml-2">No</button>
        </div>
    </div>
</div>
