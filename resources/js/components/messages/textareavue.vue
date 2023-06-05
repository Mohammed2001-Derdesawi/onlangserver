<template>
    <textarea class="elm1 form-control" v-model="message" id="tinymce" name="description_ar"></textarea>
</template>

<script src="../../../../public/assets/admin/libs/tinymce/tinymce.min.js"></script>

<script>
export default {
  name: "textareavue",
  mounted() {

    const self = this; // capture the Vue instance
    // Get the current editor instance

    tinymce.init({
      selector: "textarea.elm1",
      height: 300,
      plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "save table contextmenu directionality   paste textcolor",
      ],
      toolbar:
        "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
      image_caption: true,
      image_class_list: [
        { title: "None", value: "" },
        { title: "Responsive", value: "img-responsive" },
        { title: "Thumbnail", value: "img-thumbnail" },
      ],
      image_title: true,
      automatic_uploads: true,
      file_picker_types: "image",
      file_picker_callback: function (cb, value, meta) {
        var input = document.createElement("input");
        input.setAttribute("type", "file");
        input.setAttribute("accept", "image/*");

        input.onchange = function () {
          var file = this.files[0];
          var formData = new FormData();
          formData.append("file", file);
          var csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");
          formData.append("_token", csrfToken);
          $.ajax({
            url: "/admin/tinymic/upload/file",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
              console.log(response);
              cb(self.getUrlPicker(response)); // use the captured Vue instance
            },
          });
        };

        input.click();
      },
      init_instance_callback: function (editor) {
          // Set the content of the editor to the value of the `message` property
          editor.setContent(self.message);

          // Listen to the `change` event of the editor and update the `message` property
          editor.on("change", function () {
            self.message = editor.getContent();
            self.$emit("message-change", self.message);
          });
        },
    });
  },
  data() {
    return {
      message:'يمكنك إستعمال هذا النص كمتغير للأسماء {$name}'
    };
  },
  methods: {
    getUrlPicker(response) {
      var baseUrl = window.location.protocol + "//" + window.location.host;
      return baseUrl + "/" + response;
    },
  },

};
</script>
