<?php

namespace App\Helpers;

use Config;
use Illuminate\Support\Str;

class Helpers
{

  public static function spanRisk($val, $cek = false)
  {
    // Rentang Sistole 90-140
    if ($val == "N") {
      return "<span class='text-success'> - </span>";
    } else if ($val == "Y") {
      return "<span class='text-danger'> HIGH RISK</span>";
    } else return "-";
  }

  public static function spanAttchSebuse($val, $cek = false)
  {
    if (!empty($val)) {
      return "<a target='_blank' href='" . url('storage/' . $val) . "'> <span class='text-success'> Lihat </span> </a>";
    } else {
      return "<span class='text-danger'> - </span>";
    }
  }



  public static function groupingSebuse($data)
  {
    // Inisialisasi array untuk menampung hasil grouping
    $groupedData = [];

    foreach ($data as $row) {
      // Ambil `user_id` dan `user_name`
      $userId = $row->user_id;
      $userName = $row->user_name;
      // Ambil tahun, bulan, dan hari dari created_at
      $year = $row->created_at->format('Y');
      $month = $row->created_at->format('m');
      $day = $row->created_at->format('d');

      // Masukkan data ke dalam struktur array berdasarkan user_id
      if (!isset($groupedData[$userId])) {
        $groupedData[$userId] = [
          'user_id' => $userId,
          'user_name' => $userName,
          'userdata' => $row->user,
          'data' => []
        ];
      }

      // Inisialisasi untuk setiap tahun, bulan, dan hari jika belum ada
      if (!isset($groupedData[$userId]['data'][$year])) {
        $groupedData[$userId]['data'][$year] = [];
      }
      if (!isset($groupedData[$userId]['data'][$year][$month])) {
        $groupedData[$userId]['data'][$year][$month] = [];
      }
      if (!isset($groupedData[$userId]['data'][$year][$month][$day])) {
        $groupedData[$userId]['data'][$year][$month][$day] = [];
      }

      // Masukkan row ke hari yang sesuai
      $groupedData[$userId]['data'][$year][$month][$day][] = $row;
    }

    return $groupedData;
  }
  public static function spanStatusSebuse($val, $cek = false)
  {
    // Rentang Sistole 90-140
    if (!empty($val)) {
      if ($cek == "Y") {
        return "<span class='text-success'> Verified </span>";
      } else if ($cek == "N") {
        return "<span class='text-danger'> Not Verified</span>";
      } else return "-";
    } else {
      return "<span class='text-danger'> - </span>";
    }
  }

  public static function spanStatusSebuse2($val, $cek = false)
  {
    // Rentang Sistole 90-140
    // if (!empty($val)) {
    if ($val == "Y") {
      return "<span class='text-success'> Verified </span>";
    } else if ($val == "N") {
      return "<span class='text-danger'> Not Verified</span>";
    } else return "-";
  }

  public static function spanSistole($val, $cek = false)
  {
    // Rentang Sistole 90-140
    if ($val < 90 || $val > 140) {
      if ($cek)
        return false;
      return "<span class='text-danger'>" . $val . "</span>";
    } else {
      if ($cek)
        return true;
      return "<span class='text-success'>" . $val . "</span>";
    }
  }

  public static function spanDiastole($val, $cek = false)
  {
    // Rentang Diastole 60-100
    if ($val < 60 || $val > 100) {
      if ($cek)
        return false;
      return "<span class='text-danger'>" . $val . "</span>";
    } else {
      if ($cek)
        return true;
      return "<span class='text-success'>" . $val . "</span>";
    }
  }

  public static function spanHr($val, $cek = false)
  {
    // Rentang HR 60-120
    if ($val < 60 || $val > 120) {
      if ($cek)
        return false;
      return "<span class='text-danger'>" . $val . "</span>";
    } else {
      if ($cek)
        return true;
      return "<span class='text-success'>" . $val . "</span>";
    }
  }

  public static function spanTemp($val, $cek = false)
  {
    // Rentang Suhu 35-38
    if ($val < 35 || $val > 38) {
      if ($cek)
        return false;
      return "<span class='text-danger'>" . $val . "</span>";
    } else {
      if ($cek)
        return true;
      return "<span class='text-success'>" . $val . "</span>";
    }
  }

  public static function spanRr($val, $cek = false)
  {
    // Rentang RR 12-24
    if ($val < 12 || $val > 24) {
      if ($cek)
        return false;
      return "<span class='text-danger'>" . $val . "</span>";
    } else {
      if ($cek)
        return true;
      return "<span class='text-success'>" . $val . "</span>";
    }
  }

  public static function spanSpo2($val, $cek = false)
  {
    // Spo2 di bawah 95% dianggap berbahaya
    if (!empty($val))
      if ($val < 95) {
        if ($cek)
          return false;
        return "<span class='text-danger'>" . $val . "%</span>";
      } else {
        if ($cek)
          return true;
        return "<span class='text-success'>" . $val . "%</span>";
      }
    else return '';
  }

  public static function spanRomberg($val, $cek = false)
  {
    if ($val == 'N') {
      // dd("s", $val);
      if ($cek)
        return true;  // Negatif
      return "<span class='text-success'>Negatif</span>";
    } elseif ($val == 'Y') {
      if ($cek)
        return false;  // Positif
      return "<span class='text-danger'>Positif</span>";
    } else {
      return "<span class='text-warning'>-</span>";
    }
  }

  public static function spanAlcoholTest($val, $cek = false)
  {
    // Alkohol test -/+: N untuk negatif, Y untuk positif
    if ($val == 'N') {
      if ($cek)
        return true;  // Negatif
      return "<span class='text-success'>Negatif</span>";
    } elseif ($val == 'Y') {
      if ($cek)
        return false;  // Positif
      return "<span class='text-danger'>Positif</span>";
    } else {
      return "<span class='text-warning'>-</span>";
    }
  }



  public static function appClasses()
  {

    $data = config('custom.custom');


    // default data array
    $DefaultData = [
      'myLayout' => 'vertical',
      'myTheme' => 'theme-default',
      'myStyle' => 'light',
      'myRTLSupport' => true,
      'myRTLMode' => true,
      'hasCustomizer' => true,
      'showDropdownOnHover' => true,
      'displayCustomizer' => true,
      'contentLayout' => 'compact',
      'headerType' => 'fixed',
      'navbarType' => 'fixed',
      'menuFixed' => true,
      'menuCollapsed' => false,
      'footerFixed' => false,
      'menuFlipped' => false,
      // 'menuOffcanvas' => false,
      'customizerControls' => [
        'rtl',
        'style',
        'headerType',
        'contentLayout',
        'layoutCollapsed',
        'showDropdownOnHover',
        'layoutNavbarOptions',
        'themes',
      ],
      //   'defaultLanguage'=>'en',
    ];
    if ($data === null) {
      $data = $DefaultData;
    }
    // if any key missing of array from custom.php file it will be merge and set a default value from dataDefault array and store in data variable
    $data = array_merge($DefaultData, $data);

    // All options available in the template
    $allOptions = [
      'myLayout' => ['vertical', 'horizontal', 'blank', 'front'],
      'menuCollapsed' => [true, false],
      'hasCustomizer' => [true, false],
      'showDropdownOnHover' => [true, false],
      'displayCustomizer' => [true, false],
      'contentLayout' => ['compact', 'wide'],
      'headerType' => ['fixed', 'static'],
      'navbarType' => ['fixed', 'static', 'hidden'],
      'myStyle' => ['light', 'dark', 'system'],
      'myTheme' => ['theme-default', 'theme-bordered', 'theme-semi-dark'],
      'myRTLSupport' => [true, false],
      'myRTLMode' => [true, false],
      'menuFixed' => [true, false],
      'footerFixed' => [true, false],
      'menuFlipped' => [true, false],
      // 'menuOffcanvas' => [true, false],
      'customizerControls' => [],
      // 'defaultLanguage'=>array('en'=>'en','fr'=>'fr','de'=>'de','pt'=>'pt'),
    ];

    //if myLayout value empty or not match with default options in custom.php config file then set a default value
    foreach ($allOptions as $key => $value) {
      if (array_key_exists($key, $DefaultData)) {
        if (gettype($DefaultData[$key]) === gettype($data[$key])) {
          // data key should be string
          if (is_string($data[$key])) {
            // data key should not be empty
            if (isset($data[$key]) && $data[$key] !== null) {
              // data key should not be exist inside allOptions array's sub array
              if (!array_key_exists($data[$key], $value)) {
                // ensure that passed value should be match with any of allOptions array value
                $result = array_search($data[$key], $value, 'strict');
                if (empty($result) && $result !== 0) {
                  $data[$key] = $DefaultData[$key];
                }
              }
            } else {
              // if data key not set or
              $data[$key] = $DefaultData[$key];
            }
          }
        } else {
          $data[$key] = $DefaultData[$key];
        }
      }
    }
    $styleVal = $data['myStyle'] == "dark" ? "dark" : "light";
    if (isset($_COOKIE['style'])) {
      $styleVal = $_COOKIE['style'];
    }
    //layout classes
    $layoutClasses = [
      'layout' => $data['myLayout'],
      'theme' => $data['myTheme'],
      'style' => $styleVal,
      'styleOpt' => $data['myStyle'],
      'rtlSupport' => $data['myRTLSupport'],
      'rtlMode' => $data['myRTLMode'],
      'textDirection' => $data['myRTLMode'],
      'menuCollapsed' => $data['menuCollapsed'],
      'hasCustomizer' => $data['hasCustomizer'],
      'showDropdownOnHover' => $data['showDropdownOnHover'],
      'displayCustomizer' => $data['displayCustomizer'],
      'contentLayout' => $data['contentLayout'],
      'headerType' => $data['headerType'],
      'navbarType' => $data['navbarType'],
      'menuFixed' => $data['menuFixed'],
      'footerFixed' => $data['footerFixed'],
      'menuFlipped' => $data['menuFlipped'],
      'customizerControls' => $data['customizerControls'],
    ];

    // sidebar Collapsed
    if ($layoutClasses['menuCollapsed'] == false) {
      $layoutClasses['menuCollapsed'] = 'layout-menu-collapsed';
    }

    // Header Type
    if ($layoutClasses['headerType'] == 'fixed') {
      $layoutClasses['headerType'] = 'layout-menu-fixed';
    }
    // Navbar Type
    if ($layoutClasses['navbarType'] == 'fixed') {
      $layoutClasses['navbarType'] = 'layout-navbar-fixed';
    } elseif ($layoutClasses['navbarType'] == 'static') {
      $layoutClasses['navbarType'] = '';
    } else {
      $layoutClasses['navbarType'] = 'layout-navbar-hidden';
    }

    // Menu Fixed
    if ($layoutClasses['menuFixed'] == true) {
      $layoutClasses['menuFixed'] = 'layout-menu-fixed';
    }


    // Footer Fixed
    if ($layoutClasses['footerFixed'] == true) {
      $layoutClasses['footerFixed'] = 'layout-footer-fixed';
    }

    // Menu Flipped
    if ($layoutClasses['menuFlipped'] == true) {
      $layoutClasses['menuFlipped'] = 'layout-menu-flipped';
    }

    // Menu Offcanvas
    // if ($layoutClasses['menuOffcanvas'] == true) {
    //   $layoutClasses['menuOffcanvas'] = 'layout-menu-offcanvas';
    // }

    // RTL Supported template
    if ($layoutClasses['rtlSupport'] == true) {
      $layoutClasses['rtlSupport'] = '/rtl';
    }

    // RTL Layout/Mode
    if ($layoutClasses['rtlMode'] == true) {
      $layoutClasses['rtlMode'] = 'rtl';
      $layoutClasses['textDirection'] = 'rtl';
    } else {
      $layoutClasses['rtlMode'] = 'ltr';
      $layoutClasses['textDirection'] = 'ltr';
    }

    // Show DropdownOnHover for Horizontal Menu
    if ($layoutClasses['showDropdownOnHover'] == true) {
      $layoutClasses['showDropdownOnHover'] = true;
    } else {
      $layoutClasses['showDropdownOnHover'] = false;
    }

    // To hide/show display customizer UI, not js
    if ($layoutClasses['displayCustomizer'] == true) {
      $layoutClasses['displayCustomizer'] = true;
    } else {
      $layoutClasses['displayCustomizer'] = false;
    }

    return $layoutClasses;
  }

  public static function updatePageConfig($pageConfigs)
  {
    $demo = 'custom';
    if (isset($pageConfigs)) {
      if (count($pageConfigs) > 0) {
        foreach ($pageConfigs as $config => $val) {
          Config::set('custom.' . $demo . '.' . $config, $val);
        }
      }
    }
  }

  public static function formatDateIndonesia($date)
  {
    // Set locale to Bahasa Indonesia
    \Carbon\Carbon::setLocale('id');

    return \Carbon\Carbon::parse($date)->isoFormat('dddd, D MMMM YYYY, [Pukul] HH:mm');
  }
}

// if (!function_exists('formatDateIndonesia')) {
//   function formatDateIndonesia($date)
//   {
//     // Set locale to Bahasa Indonesia
//     \Carbon\Carbon::setLocale('id');

//     return \Carbon\Carbon::parse($date)->isoFormat('dddd, D MMMM YYYY, [Pukul] HH:mm');
//   }
// }
