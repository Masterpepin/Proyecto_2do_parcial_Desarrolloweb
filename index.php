<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet"> <!-- Referencia al archivo CSS externo -->
  </head>
  <body>
    <header>
      <h2>Visitas a museos</h2>
    </header>
    <div class="container mt-3">
      <div class="row">
        <div class="col-md-1">
          <div class="search-container">
            <button class="search-button">Buscar</button>
          </div>
        </div>
      </div>
    </div>
    <div class="container mt-3 alert-container">
        <div class="alert custom-alert" role="alert">
          <div class="row">
            <div class="col">
                <div class="alert-section custom-alert-sections">
                <div class="ale rt-text custom-alert-text-margin">Visitas</div>
              </div>
            </div>
            <div class="col">
                <div class="alert-section custom-alert-sections">
                <div class="ale rt-text custom-alert-text-margin">No. Nacionales</div>
              </div>
            </div>
            <div class="col">
              <div class="alert-section custom-alert-sections">
                <div class="alert-text custom-alert-text-margin">No. Extranjeros</div>
              </div>
            </div>
            <div class="col">
              <div class="alert-section custom-alert-sections">
                <div class="alert-text custom-alert-text-margin">Primera lengua</div>
              </div>
            </div>
            <div class="col">
              <div class="alert-section custom-alert-sections">
                <div class="alert-text custom-alert-text-margin">Segunda lengua</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <div class="container mt-3 d-flex full-height">
        <div class="m-auto card overflow-x-auto invisible-thing"> 
            <table id="data-table" class="table table-custom no-border">

        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="./js/script.js"></script>
  </body>
</html>
