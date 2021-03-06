tinymce.init({
	selector: "textarea.tinymce",
  language: 'fr_FR',
	theme: 'modern',
	branding: false,

	height: 300,
	width: '100%',
  theme: 'modern',
  plugins: 'print preview searchreplace autolink directionality visualblocks visualchars image link template charmap hr nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
  toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
  image_advtab: true,
  templates: [
    { title: 'Test template 1', content: 'Test 1' },
    { title: 'Test template 2', content: 'Test 2' }
  ],
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css'
  ]

});
