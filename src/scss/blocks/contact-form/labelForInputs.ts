export default function labelForInputs() {
  const form = document.querySelector(".form");
  if (form) {
    const inputs = form.querySelectorAll(
      "input[type='text'], input[type='email'], input[type='tel'], input[type='password'], textarea"
    ) as NodeListOf<HTMLInputElement | HTMLTextAreaElement>;
    inputs.forEach((input) => {
      input.setAttribute("id", input.name);
      input.setAttribute("autocomplete", "input.name");
      const label = document.createElement("label");
      label.classList.add("form__label");
      label.setAttribute('style', 'display: none;');
      label.setAttribute("for", input.name);
      if (input.placeholder) {
        label.innerText = input.placeholder;
      } else {
        label.innerText = input.name;
      }
      input.insertAdjacentElement("beforebegin", label);
    });
  }
}
