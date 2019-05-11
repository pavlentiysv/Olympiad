$(".answer-bar-btn").on("click", function(e) {
  e.preventDefault();
  $(".answer-bar").toggleClass("answer-bar_active");
  // $(".content").toggleClass("content_active");
});
