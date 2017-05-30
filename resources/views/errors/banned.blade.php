<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Smans / Ваш аккаунт заблокирован</title>
</head>

<style>
  html, body {
    height: 100%;
  }
  body {
    margin: 0;
  }
  .flex-container {
    height: 100%;
    padding: 0;
    margin: 0;
    display: -webkit-box;
    display: -moz-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    align-items: center;
    justify-content: center;
    width: auto;
    color: #606365;
    text-align: center;
  }
  a {
    color: #606365;
  }
</style>
<body>
  <div class="flex-container">
    <div>
      <h2>Ваш аккаунт заблокирован</h2>
      <form action="/logout" method="post">
        {{ csrf_field() }}
        <button type="submit">Выйти</button>
      </form>
    </div>
  </div>
</body>
</html>
