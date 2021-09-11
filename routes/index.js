const express = require("express");
const MainController = require("../controller/mainController");
const router = express.Router();

router.get("/", async (req, res, next) => {
  res.render("index", await MainController.list());
});
router.get("/manifesto", function (req, res, next) {
  res.render("manifesto", MainController.manifesto());
});
router.get("/about", function (req, res, next) {
  res.render("about", MainController.about());
});

module.exports = router;
