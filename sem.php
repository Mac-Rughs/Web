<!DOCTYPE html>
<html>
<head>
  <title>Dropdown Example</title>
</head>
<body>
  <h1>Dropdown Example</h1>

  <form>
    <label for="main-dropdown">Method Of Study:</label>
    <select id="main-dropdown" name="selected_category">
      <option value="category1">Full Mark 1</option>
      <option value="category2">Pass Mark</option>
    </select>

    <label for="sub-dropdown">Semester:</label>
    <select id="sub-dropdown" name="selected_option">
    </select>

    <br>
    <input type="submit" value="Submit">
  </form>

  <div id="result" style="margin-top: 20px; font-weight: bold;"></div>

  <script>
    // Function to update the semester dropdown options based on the selected method of study
    function updateSemesterOptions() {
      var mainDropdown = document.getElementById("main-dropdown");
      var subDropdown = document.getElementById("sub-dropdown");
      
      // Retrieve the selected category
      var selectedCategory = mainDropdown.value;

      // Clear existing options
      subDropdown.innerHTML = "";

      // Generate new options dynamically based on the selected category
      if (selectedCategory === "category1") {
        addOption(subDropdown, "option1", "Semester 1");
        addOption(subDropdown, "option2", "Semester 2");
        addOption(subDropdown, "option3", "Semester 3");
        addOption(subDropdown, "option4", "Semester 4");
        addOption(subDropdown, "option5", "Semester 5");
        addOption(subDropdown, "option6", "Semester 6");
        addOption(subDropdown, "option7", "Semester 7");
        addOption(subDropdown, "option8", "Semester 8");
      } else if (selectedCategory === "category2") {
        addOption(subDropdown, "option1", "Semester 1");
        addOption(subDropdown, "option2", "Semester 2");
        addOption(subDropdown, "option3", "Semester 3");
        addOption(subDropdown, "option4", "Semester 4");
        addOption(subDropdown, "option5", "Semester 5");
        addOption(subDropdown, "option6", "Semester 6");
        addOption(subDropdown, "option7", "Semester 7");
        addOption(subDropdown, "option8", "Semester 8");
      }
    }

    // Function to add an option to the dropdown
    function addOption(dropdown, value, text) {
      var option = document.createElement("option");
      option.value = value;
      option.text = text;
      dropdown.add(option);
    }

    // Attach an event listener to the main dropdown to trigger the update of the semester options
    var mainDropdown = document.getElementById("main-dropdown");
    mainDropdown.addEventListener("change", updateSemesterOptions);

    // Attach an event listener to the form submit button
    var form = document.querySelector("form");
    form.addEventListener("submit", function(event) {
      event.preventDefault(); // Prevent the form from submitting

      // Retrieve the selected category and option
      var selectedCategory = mainDropdown.value;
      var selectedOption = document.getElementById
