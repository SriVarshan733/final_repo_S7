<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="contact.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="wrapper centered">
  <article class="letter">
    <div class="side">
      <h1>Contact us</h1>
      <p>
        <textarea placeholder="Your message"></textarea>
      </p>
    </div>
    <div class="side">
      <p>
        <input type="text" placeholder="Your name" >
      </p>
      <p>
        <input type="email" placeholder="Your email" >
      </p>
      <p>
        <button id="sendLetter">Send</button>
      </p>
    </div>
  </article>
  <div class="envelope front"></div>
  <div class="envelope back"></div>
</div>
<p class="result-message centered">Thank you for your message</p>
<!-- partial -->
  <script  src="contact.js"></script>

</body>
</html>