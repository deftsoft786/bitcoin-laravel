@include('bitcoin/inner_header')    

    <main class="mainBody">



        <div class="body-inner">

          <div class="container">

            <div class="body-box">



              <div class="trading">

                <div class="row">

                  <div class="col-md-6">

                    <div class="trading-dropdown">

                      <span>Select Cryptocurrency</span>

                      <div class="filter-select">

                        <select>

                          <option>BTC/ETH</option>

                          <option>ERC20</option>

                        </select>

                      </div>

                    </div>

                    <div class="trading-graph">

                      <iframe height="400" width="800" src="https://sslcharts.forexprostools.com/index.php?force_lang=1&pair_ID=21&timescale=300&candles=100&style=candles"></iframe>

                    </div>

                  </div>

                  <div class="col-md-6">

                    <h1 class="small-table-heading">Order Summary</h1>

                    <div class="table-container">

                      <table class="small-body-table table table-striped">

                        <thead>

                          <tr>

                            <th>Time</th>

                            <th>Order ID</th>

                            <th>Avg. Price</th>

                            <th>Price</th>

                            <th>Total</th>

                          </tr>

                        </thead>

                        <tbody>

                          <tr>

                            <td>12:00 am</td>

                            <td>00456</td>

                            <td>BTC20</td>

                            <td>BTC25</td>

                            <td>BTC40</td>

                          </tr>

                          <tr>

                            <td>12:00 am</td>

                            <td>00456</td>

                            <td>BTC20</td>

                            <td>BTC25</td>

                            <td>BTC40</td>

                          </tr>

                          <tr>

                            <td>12:00 am</td>

                            <td>00456</td>

                            <td>BTC20</td>

                            <td>BTC25</td>

                            <td>BTC40</td>

                          </tr>

                          <tr>

                            <td>12:00 am</td>

                            <td>00456</td>

                            <td>BTC20</td>

                            <td>BTC25</td>

                            <td>BTC40</td>

                          </tr>

                        </tbody>

                      </table>

                    </div>

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>



      </main>

@include('bitcoin/inner_footer')  