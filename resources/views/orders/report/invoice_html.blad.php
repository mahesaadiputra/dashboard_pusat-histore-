<!DOCTYPE html>
<html>
  <head>
    <title>Invoice #{{ $order->invoice }</title>
    <meta name="csrf-param" content="authenticity_token" />
<meta name="csrf-token" content="NR2hnXR3Yb3cQq1MAExX6Zv4weRCljZwby51l9whLfttnNJ2bdpsVMts4zC+Jf2DZf6HlImLfNHx4NgutVP/bQ==" />

    <link rel="stylesheet" media="all" href="/assets/application-e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855.css" data-turbolinks-track="reload" />
    <script src="/assets/application-c3b018a2e60c11f22013c2b6054786b5abe80422cfaeed306586a6e4010f1047.js" data-turbolinks-track="reload"></script>
  </head>

  <body>
    <!DOCTYPE html>
<html style="font-family: Helvetica, Arial !important; font-size: 12px !important;">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>HiStore Invoice</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,300,400italic" rel='stylesheet' type='text/css'>
    <meta name="csrf-param" content="authenticity_token" />
<meta name="csrf-token" content="aCFXE2ByGv/RAqWGFFZKcq0lMPy5F4wB3txaerk77DgwoCT4ed8XFsYs6/qqP+AYUyN2jHIKxqBAEvfD0Ek+rg==" />
    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />
    <style>
    @media only screen and (min-device-width : 320px) and (max-device-width : 736px) {
      table {
        table-layout: fixed !important;
        width: 100% !important;
      }
      img.google-maps {
        width: 100% !important;
      }
    }
    </style>
  </head>
  <body>


      <table width="100%">
  <tr>
    <td>
      <!--header-->
      <table align="center" style="width:450px; border:1px solid #ddd;  background:#f6f6f6;" cellpadding="0" cellspacing="0">
        <tr style="background:#F8961C; color:#fff; text-align:center;">
          <td>
            <table width="100%" style="border-top:20px solid #F8961C;">
              <tr>
                <td style="text-align:center;">
                  <div>
                    <img src="https://ipehapp.intek.id/dashboard/ez.jpg" width="150" height="auto"
                      style="border-fit: cover; border-radius: 50%;" />
                  </div>
                </td>
              </tr>
              <tr>
                <td style="text-align:center; color:#ffffff; padding-top:10px;">
                  <h2 style="font-weight:500; font-size:25px;">HiStore Invoice Receipt</h2>
                </td>
              </tr>
            </table>
          </td>
        </tr>


        <tr>
          <td>
            <table width="100%" align="center" style="border-left:20px solid #f6f6f6; border-right:20px solid #f6f6f6;" cellpadding="0" cellspacing="0">
              <tr>
                <td>
                  <!-- amount -->
                  <table align="center" width="100%" style="border-top:20px solid #f6f6f6; text-align: center;" cellpadding="0" cellspacing="0">
                    <tr>
                      <td style="border:1px solid #ddd; background:#fff; padding:20px; font-size:35px; color:#2c3e50;">
                        Rp. 392.500
                      </td>
                    </tr>
                  </table>
                  <!--/amount-->
                </td>
              </tr>
              <tr>
                <td>
                  <!-- detail info -->
                  <table align="center" width="100%" style="border-top:20px solid #f6f6f6; text-align: center; background:#fff; " cellpadding="0" cellspacing="0">
                    <tr>
                      <td>
                        <table align="center" width="100%"  cellpadding="0" cellspacing="0" style="border:1px solid #ddd; padding-left:10px; padding-right:10px; padding-top:10px; ">
                          <tr>
                            <td style="color:#AFAFAF; text-align:left; font-size:13px; padding-bottom:10px; width: 40%;" colspan="2">
                              Tanggal Beli
                            </td>
                            <td style="color:#AFAFAF; text-align:right; font-size:13px; padding-bottom:10px; width: 60%;">
                                02 November 2019 17:36
                            </td>
                          </tr>

                          <tr>
                            <td style="color:#AFAFAF; text-align:left; font-size:13px; padding-bottom:10px;" colspan="2">
                              Receipt Number
                            </td>
                            <td style="color:#AFAFAF; text-align:right; font-size:13px; padding-bottom:10px;">
                              #{{ $order->invoice }
                            </td>
                          </tr>

                            <tr>
                              <td style="color:#AFAFAF; text-align:left; font-size:13px; padding-bottom:10px;" colspan="2">
                                Customer
                              </td>
                              <td style="color:#AFAFAF; text-align:right; font-size:13px; padding-bottom:10px;">
                                Nani Astuti
                              </td>
                            </tr>


                            <tr>
                              <td style="color:#AFAFAF; text-align:left; font-size:13px; padding-bottom:10px;">
                                Mitra
                              </td>
                              <td style="color:#AFAFAF; text-align:right; font-size:13px; padding-bottom:10px;" colspan="2">
                                Ajeng Putri
                              </td>
                            </tr>

                          <!-- <tr>
                            <td style="color:#AFAFAF; text-align:left; font-size:13px; padding-bottom:10px;">
                              Collected By
                            </td>
                            <td style="color:#AFAFAF; text-align:right; font-size:13px; padding-bottom:10px;" colspan="2">
                              Ajeng Putri
                            </td>
                          </tr> -->

                          <tr>
                            <td colspan="3" style="border-bottom:1px solid #ddd; padding-top:10px;"></td>
                          </tr>





                              <tr>
                                <td style="text-align:left; padding-top:10px; font-size:13px;" colspan="2">
                                  Premium Eyelash Extension x 1
                                    <br />
                                    <br />
                                    <span style="color: #AFAFAF; padding-left: 10px; padding-top:10px;">
                                      T3 PEE
                                    </span>
                                </td>
                                <td style="text-align:right; padding-bottom:15px; padding-top:10px; ">
                                    Rp. 380.000
                                </td>
                              </tr>





                              <!-- Promo Notation-->
                              <!-- End Promo-->
<!-- 

                              <tr>
                                <td style="text-align:left; padding-top:10px; font-size:13px;" colspan="2">
                                  DL - Panthenol Essence Mascara x 1
                                    <br />
                                    <br />
                                    <span style="color: #AFAFAF; padding-left: 10px; padding-top:10px;">
                                      C1 PEM
                                    </span>
                                </td>
                                <td style="text-align:right; padding-bottom:15px; padding-top:10px; ">
                                    Rp. 250.000
                                </td>
                              </tr> -->




                                <tr>
                                  <td colspan="3">
                                    <span style="font-style: italic; color: #AFAFAF; display: block; word-wrap: break-word; float: left; text-align: left; padding-left: 10px; padding-top:10px;">
                                      <!-- By ajeng -->
                                    </span>
                                  </td>
                                </tr>

                              <!-- Promo Notation-->
                              <!-- End Promo-->


                          <!-- Loyalty Redeemed Reward-->
                          <!--Endif Loyalty Redeemed Reward-->

                          <!-- space-->
                          <tr>
                            <td colspan="3" style="border-bottom:1px solid #ddd; padding-top:15px;"></td>
                          </tr>
                          <!-- /space-->

                          <tr>
                            <td style="text-align:left; padding-top:10px;">Subtotal</td>
                            <td>&nbsp;</td>
                            <td style="text-align:right; padding-top:10px;">
                              Rp. 380.000
                            </td>
                          </tr>

                          <tr>
                            <td style="text-align:left; padding-top:10px;">Biaya Admin</td>
                            <td>&nbsp;</td>
                            <td style="text-align:right; padding-top:10px;">
                              Rp. 2.500
                            </td>
                          </tr>

                          <tr>
                            <td style="text-align:left; padding-top:10px;">Biaya Ongkos Kirim</td>
                            <td>&nbsp;</td>
                            <td style="text-align:right; padding-top:10px;">
                              Rp. 10.000
                            </td>
                          </tr>

                              <tr>
                                <td style="text-align:left; padding-top:10px;">
                                  Service
                                  (Included)
                                  
                                </td>
                                <td style="text-align:right; padding-top:10px;" colspan="2">
                                    &nbsp;
                                </td>
                              </tr>

                              <tr>
                                <td style="text-align:left; padding-top:10px;">
                                  PPN
                                  (Included)
                                  
                                </td>
                                <td>&nbsp;</td>
                                <td style="text-align:right; padding-top:10px;">
                                    &nbsp;
                                </td>
                              </tr>


                          <tr>
                            <td colspan="3" style="border-bottom:1px solid #ddd; padding-top:15px;"></td>
                          </tr>
                          <tr>
                            <td style="text-align:left; padding-top:10px; font-size:18px;">Total</td>
                            <td style="text-align:right; padding-top:10px; font-size:18px;" colspan="2">
                              Rp. 392.500
                            </td>
                          </tr>

                          <tr>
                            <td style="text-align:left; padding-top:10px;">
                              <div style="float: left; color:#AFAFAF;">
                                  HiPay
                              </div>
                            </td>
                            <td>&nbsp;</td>
                            <td style="text-align:right; padding-top:10px; color:#AFAFAF;">
                              Rp. 392.500
                            </td>
                          </tr>

                          <tr>
                            <td colspan="3">
                              <div>
                                <div class="payment-note" align="left" style="color:#AFAFAF; padding-top:10px;">
                                  
                                </div>
                              </div>
                            </td>
                          </tr>


                          <!-- Loyalty -->
                          <!-- End if Loyalty  -->

                          <!-- space-->
                          <tr>
                            <td colspan="3" style="padding-top:10px;">&nbsp;</td>
                          </tr>
                          <!-- /space-->

                        </table>
                      </td>
                    </tr>

                    <!-- <tr>
                      <td style="border-left:1px solid #ddd; border-right:1px solid #ddd;">
                          <img class="google-maps" src="https://maps.google.com/maps/api/staticmap?size=450x300&amp;sensor=false&amp;zoom=16&amp;markers=%2C&amp;key=AIzaSyD0ULatimmx5eGCtgHumzAAg9-pnTRFUJU" alt="Staticmap?size=450x300&amp;sensor=false&amp;zoom=16&amp;markers=%2c&amp;key=aizasyd0ulatimmx5egctghumzaag9 pntrfuju" />
                      </td>
                    </tr> -->
                    <tr>
                      <td style="text-align:center; border:1px solid #ddd; border-bottom:0;">
                        <p style="margin-bottom: -5px; font-size:13px"><br />Alamat</p>
                        <p style="color:#AFAFAF;">
                          Jalan Buah Batu no. 28,
                          Bandung,
                          Jawa Barat,
                          40262
                          <br /><br />
                          0227302860
                        </p>

                          <p style="margin-bottom: -5px;">Notes</p>
                          <p style="color:#AFAFAF;">
                            This transaction is NOT refundable.
Thanks and see you on the next treatment !
                          </p>
                      </td>
                    </tr>

                    <tr>
                      <td style="padding-left:10px; padding-right:10px; border:1px solid #ddd; padding-bottom:10px; border-top:0;">
                        <br />
                        <!-- <ul class="list" style="list-style:none;margin:0;padding:0;margin-left: 20px;">
                          <li style="display:inline;width:25%;padding-right: 20px;">
                            <a href="javascript:void(0)" style="color:#fff;">
                              <img src="/images/globe.jpg" style="width: 24px;" />
                            </a>
                          </li>
                          <li style="display:inline;padding-right: 20px;">
                            <a href="javascript:void(0)" style="color:#fff;">
                              <img src="/images/twitter.png" style="width: 24px;" />
                            </a>
                          </li>
                          <li style="display:inline;padding-right: 20px;">
                            <a href="javascript:void(0)" style="color:#fff;" >
                              <img src="/images/facebook.png" style="width: 24px;"  />
                            </a>
                          </li>
                          <li style="display:inline;padding-right: 20px;">
                            <a href="https://www.instagram.com/bobcat.id" style="color:#fff;">
                              <img src="/images/instagram.png" style="width: 24px;"  />
                            </a>
                          </li>
                        </ul> -->
                        <br /><br />
                      </td>
                    </tr>
                  </table>
                    <!--/detail info-->
                </td>
              </tr>
            </table>
          </td>
        </tr>

        <tr>
          <td style="font-size:13px; color:#AFAFAF; text-align:center;">
            <p style="margin-bottom: -10px; color:#b7b7b7">
              <br /><br />
              &copy; 2019 PT Intek Indonesia. All Right Reserved
            </p>

            <p>
              <a href="https://mokapos.com/privacy" style="color:#b7b7b7; text-decoration: none;">
                Privacy Policy
              </a>
            </p>
          </td>
        </tr>
        <tr>
          <td style="text-align:center;">
            <a href="https://histore.id"><img src="https://mokapos.com/images/logo-moka.png" width="28px" height="auto"  style="margin-bottom:10px" /></a>
          </td>
        </tr>
      </table>
      <!--/header-->
    </td>
  </tr>
</table>

  </body>
</html>

  </body>
</html>
