<div class="panel panel-default">
  <div class="panel-heading">
      <div class="panel-title">Поиск</div>
  </div>

  <div class="panel-body">
    <div class="input-group">
      <input type="text" class="form-control" id="searchInput" placeholder="Введите текст для поиска...">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button" id="searchBtn">Найти</button>
        <button class="btn btn-default" type="button" id="cancelBtn">Сбросить</button>
      </span>
    </div>

    <hr id="searchHr" style="display:none;">

    <table class="table table-striped" id="searchTable" style="display:none;">
        <thead id="searchTableHead"></thead>
        <tbody id="searchTableBody"></tbody>
      </table>
  </div>
</div>
