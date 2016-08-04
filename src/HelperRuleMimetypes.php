<?php
/**
 * Created by Larakit.
 * Link: http://github.com/larakit
 * User: Alexey Berdnikov
 * Date: 17.05.16
 * Time: 15:06
 */

namespace Larakit;

class HelperRuleMimetypes {

    protected $types = [];

    function __toString() {
        $ret = [];
        foreach($this as $k => $v) {
            if($v) {
                $ret[] = $k . '=' . $v;
            }
        }

        return (string) implode(',', $ret);
    }

    function add7z() {
        $this->types['application/x-7z-compressed'] = 'application/x-7z-compressed';
    }

    function addAbw() {
        $this->types['application/x-abiword'] = 'application/x-abiword';
    }

    function addAcx() {
        $this->types['application/internet-property-stream'] = 'application/internet-property-stream';
    }

    function addAi() {
        $this->types['application/postscript'] = 'application/postscript';
    }

    function addAif() {
        $this->types['audio/x-aiff'] = 'audio/x-aiff';
    }

    function addAifc() {
        $this->types['audio/x-aiff'] = 'audio/x-aiff';
    }

    function addAiff() {
        $this->types['audio/x-aiff'] = 'audio/x-aiff';
    }

    function addAmf() {
        $this->types['application/x-amf'] = 'application/x-amf';
    }

    function addAsf() {
        $this->types['video/x-ms-asf'] = 'video/x-ms-asf';
    }

    function addAsr() {
        $this->types['video/x-ms-asf'] = 'video/x-ms-asf';
    }

    function addAsx() {
        $this->types['video/x-ms-asf'] = 'video/x-ms-asf';
    }

    function addAtom() {
        $this->types['application/atom+xml'] = 'application/atom+xml';
    }

    function addAvi() {
        $this->types['video/avi']       = 'video/avi';
        $this->types['video/msvideo']   = 'video/msvideo';
        $this->types['video/x-msvideo'] = 'video/x-msvideo';
    }

    function addBin() {
        $this->types['application/octet-stream'] = 'application/octet-stream';
        $this->types['application/macbinary']    = 'application/macbinary';
    }

    function addBmp() {
        $this->types['image/bmp'] = 'image/bmp';
    }

    function addC() {
        $this->types['text/x-csrc'] = 'text/x-csrc';
    }

    function addCPlusPlus() {
        $this->types['text/x-c++src'] = 'text/x-c++src';
    }

    function addCab() {
        $this->types['application/x-cab'] = 'application/x-cab';
    }

    function addCc() {
        $this->types['text/x-c++src'] = 'text/x-c++src';
    }

    function addCda() {
        $this->types['application/x-cdf'] = 'application/x-cdf';
    }

    function addClass() {
        $this->types['application/octet-stream'] = 'application/octet-stream';
    }

    function addCpp() {
        $this->types['text/x-c++src'] = 'text/x-c++src';
    }

    function addCpt() {
        $this->types['application/mac-compactpro'] = 'application/mac-compactpro';
    }

    function addCsh() {
        $this->types['text/x-csh'] = 'text/x-csh';
    }

    function addCss() {
        $this->types['text/css'] = 'text/css';
    }

    function addCsv() {
        $this->types['text/x-comma-separated-values'] = 'text/x-comma-separated-values';
        $this->types['application/vnd.ms-excel']      = 'application/vnd.ms-excel';
        $this->types['text/comma-separated-values']   = 'text/comma-separated-values';
        $this->types['text/csv']                      = 'text/csv';
    }

    function addDbk() {
        $this->types['application/docbook+xml'] = 'application/docbook+xml';
    }

    function addDcr() {
        $this->types['application/x-director'] = 'application/x-director';
    }

    function addDeb() {
        $this->types['application/x-debian-package'] = 'application/x-debian-package';
    }

    function addDiff() {
        $this->types['text/x-diff'] = 'text/x-diff';
    }

    function addDir() {
        $this->types['application/x-director'] = 'application/x-director';
    }

    function addDivx() {
        $this->types['video/divx'] = 'video/divx';
    }

    function addDll() {
        $this->types['application/octet-stream']    = 'application/octet-stream';
        $this->types['application/x-msdos-program'] = 'application/x-msdos-program';
    }

    function addDmg() {
        $this->types['application/x-apple-diskimage'] = 'application/x-apple-diskimage';
    }

    function addDms() {
        $this->types['application/octet-stream'] = 'application/octet-stream';
    }

    function addDoc() {
        $this->types['application/msword'] = 'application/msword';
    }

    function addDocx() {
        $this->types['application/vnd.openxmlformats-officedocument.wordprocessingml.document'] = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
    }

    function addDvi() {
        $this->types['application/x-dvi'] = 'application/x-dvi';
    }

    function addDxr() {
        $this->types['application/x-director'] = 'application/x-director';
    }

    function addEml() {
        $this->types['message/rfc822'] = 'message/rfc822';
    }

    function addEps() {
        $this->types['application/postscript'] = 'application/postscript';
    }

    function addEvy() {
        $this->types['application/envoy'] = 'application/envoy';
    }

    function addExe() {
        $this->types['application/x-msdos-program'] = 'application/x-msdos-program';
        $this->types['application/octet-stream']    = 'application/octet-stream';
        $this->types['application/x-dosexec']       = 'application/x-dosexec';
    }

    function addFla() {
        $this->types['application/octet-stream'] = 'application/octet-stream';
    }

    function addFlac() {
        $this->types['application/x-flac'] = 'application/x-flac';
    }

    function addFlc() {
        $this->types['video/flc'] = 'video/flc';
    }

    function addFli() {
        $this->types['video/fli'] = 'video/fli';
    }

    function addFlv() {
        $this->types['video/x-flv'] = 'video/x-flv';
    }

    function addGif() {
        $this->types['image/gif'] = 'image/gif';
    }

    function addGtar() {
        $this->types['application/x-gtar'] = 'application/x-gtar';
    }

    function addGz() {
        $this->types['application/x-gzip'] = 'application/x-gzip';
    }

    function addH() {
        $this->types['text/x-chdr'] = 'text/x-chdr';
    }

    function addHPlusPlus() {
        $this->types['text/x-c++hdr'] = 'text/x-c++hdr';
    }

    function addHh() {
        $this->types['text/x-c++hdr'] = 'text/x-c++hdr';
    }

    function addHpp() {
        $this->types['text/x-c++hdr'] = 'text/x-c++hdr';
    }

    function addHqx() {
        $this->types['application/mac-binhex40'] = 'application/mac-binhex40';
    }

    function addHs() {
        $this->types['text/x-haskell'] = 'text/x-haskell';
    }

    function addHtm() {
        $this->types['text/html'] = 'text/html';
    }

    function addHtml() {
        $this->types['text/html'] = 'text/html';
    }

    function addIco() {
        $this->types['image/x-icon'] = 'image/x-icon';
    }

    function addIcs() {
        $this->types['text/calendar'] = 'text/calendar';
    }

    function addIii() {
        $this->types['application/x-iphone'] = 'application/x-iphone';
    }

    function addIns() {
        $this->types['application/x-internet-signup'] = 'application/x-internet-signup';
    }

    function addIso() {
        $this->types['application/x-iso9660-image'] = 'application/x-iso9660-image';
    }

    function addIsp() {
        $this->types['application/x-internet-signup'] = 'application/x-internet-signup';
    }

    function addJar() {
        $this->types['application/java-archive'] = 'application/java-archive';
    }

    function addJava() {
        $this->types['application/x-java-applet'] = 'application/x-java-applet';
    }

    function addJpeg() {
        $this->types['image/jpeg']  = 'image/jpeg';
        $this->types['image/pjpeg'] = 'image/pjpeg';
        $this->types['image/jpeg']  = 'image/jpeg';
        $this->types['image/pjpeg'] = 'image/pjpeg';
        $this->types['image/jpeg']  = 'image/jpeg';
        $this->types['image/pjpeg'] = 'image/pjpeg';
    }

    function addJs() {
        $this->types['application/javascript'] = 'application/javascript';
    }

    function addJson() {
        $this->types['application/json'] = 'application/json';
    }

    function addLatex() {
        $this->types['application/x-latex'] = 'application/x-latex';
    }

    function addLha() {
        $this->types['application/octet-stream'] = 'application/octet-stream';
    }

    function addLog() {
        $this->types['text/plain'] = 'text/plain';
        $this->types['text/x-log'] = 'text/x-log';
    }

    function addLzh() {
        $this->types['application/octet-stream'] = 'application/octet-stream';
    }

    function addM4a() {
        $this->types['audio/mpeg'] = 'audio/mpeg';
    }

    function addM4p() {
        $this->types['video/mp4v-es'] = 'video/mp4v-es';
    }

    function addM4v() {
        $this->types['video/mp4'] = 'video/mp4';
    }

    function addMan() {
        $this->types['application/x-troff-man'] = 'application/x-troff-man';
    }

    function addMdb() {
        $this->types['application/x-msaccess'] = 'application/x-msaccess';
    }

    function addMidi() {
        $this->types['audio/midi'] = 'audio/midi';
    }

    function addMid() {
        $this->types['audio/midi'] = 'audio/midi';
    }

    function addMif() {
        $this->types['application/vnd.mif'] = 'application/vnd.mif';
    }

    function addMka() {
        $this->types['audio/x-matroska'] = 'audio/x-matroska';
    }

    function addMkv() {
        $this->types['video/x-matroska'] = 'video/x-matroska';
    }

    function addMov() {
        $this->types['video/quicktime'] = 'video/quicktime';
    }

    function addMovie() {
        $this->types['video/x-sgi-movie'] = 'video/x-sgi-movie';
    }

    function addMp2() {
        $this->types['audio/mpeg'] = 'audio/mpeg';
    }

    function addMp3() {
        $this->types['audio/mpeg'] = 'audio/mpeg';
    }

    function addMp4() {
        $this->types['application/mp4'] = 'application/mp4';
        $this->types['audio/mp4']       = 'audio/mp4';
        $this->types['video/mp4']       = 'video/mp4';
    }

    function addMpa() {
        $this->types['video/mpeg'] = 'video/mpeg';
    }

    function addMpe() {
        $this->types['video/mpeg'] = 'video/mpeg';
    }

    function addMpeg() {
        $this->types['video/mpeg'] = 'video/mpeg';
    }

    function addMpg() {
        $this->types['video/mpeg'] = 'video/mpeg';
    }

    function addMpg4() {
        $this->types['video/mp4'] = 'video/mp4';
    }

    function addMpga() {
        $this->types['audio/mpeg'] = 'audio/mpeg';
    }

    function addMpp() {
        $this->types['application/vnd.ms-project'] = 'application/vnd.ms-project';
    }

    function addMpv() {
        $this->types['video/x-matroska'] = 'video/x-matroska';
    }

    function addMpv2() {
        $this->types['video/mpeg'] = 'video/mpeg';
    }

    function addMs() {
        $this->types['application/x-troff-ms'] = 'application/x-troff-ms';
    }

    function addMsg() {
        $this->types['application/msoutlook'] = 'application/msoutlook';
        $this->types['application/x-msg']     = 'application/x-msg';
    }

    function addMsi() {
        $this->types['application/x-msi'] = 'application/x-msi';
    }

    function addNws() {
        $this->types['message/rfc822'] = 'message/rfc822';
    }

    function addOda() {
        $this->types['application/oda'] = 'application/oda';
    }

    function addOdb() {
        $this->types['application/vnd.oasis.opendocument.database'] = 'application/vnd.oasis.opendocument.database';
    }

    function addOdc() {
        $this->types['application/vnd.oasis.opendocument.chart'] = 'application/vnd.oasis.opendocument.chart';
    }

    function addOdf() {
        $this->types['application/vnd.oasis.opendocument.forumla'] = 'application/vnd.oasis.opendocument.forumla';
    }

    function addOdg() {
        $this->types['application/vnd.oasis.opendocument.graphics'] = 'application/vnd.oasis.opendocument.graphics';
    }

    function addOdi() {
        $this->types['application/vnd.oasis.opendocument.image'] = 'application/vnd.oasis.opendocument.image';
    }

    function addOdm() {
        $this->types['application/vnd.oasis.opendocument.text-master'] = 'application/vnd.oasis.opendocument.text-master';
    }

    function addOdp() {
        $this->types['application/vnd.oasis.opendocument.presentation'] = 'application/vnd.oasis.opendocument.presentation';
    }

    function addOds() {
        $this->types['application/vnd.oasis.opendocument.spreadsheet'] = 'application/vnd.oasis.opendocument.spreadsheet';
    }

    function addOdt() {
        $this->types['application/vnd.oasis.opendocument.text'] = 'application/vnd.oasis.opendocument.text';
    }

    function addOga() {
        $this->types['audio/ogg'] = 'audio/ogg';
    }

    function addOgg() {
        $this->types['application/ogg'] = 'application/ogg';
    }

    function addOgv() {
        $this->types['video/ogg'] = 'video/ogg';
    }

    function addOtg() {
        $this->types['application/vnd.oasis.opendocument.graphics-template'] = 'application/vnd.oasis.opendocument.graphics-template';
    }

    function addOth() {
        $this->types['application/vnd.oasis.opendocument.web'] = 'application/vnd.oasis.opendocument.web';
    }

    function addOtp() {
        $this->types['application/vnd.oasis.opendocument.presentation-template'] = 'application/vnd.oasis.opendocument.presentation-template';
    }

    function addOts() {
        $this->types['application/vnd.oasis.opendocument.spreadsheet-template'] = 'application/vnd.oasis.opendocument.spreadsheet-template';
    }

    function addOtt() {
        $this->types['application/vnd.oasis.opendocument.template'] = 'application/vnd.oasis.opendocument.template';
    }

    function addP() {
        $this->types['text/x-pascal'] = 'text/x-pascal';
    }

    function addPas() {
        $this->types['text/x-pascal'] = 'text/x-pascal';
    }

    function addPatch() {
        $this->types['text/x-diff'] = 'text/x-diff';
    }

    function addPbm() {
        $this->types['image/x-portable-bitmap'] = 'image/x-portable-bitmap';
    }

    function addPdf() {
        $this->types['application/pdf']        = 'application/pdf';
        $this->types['application/x-download'] = 'application/x-download';
    }

    function addPhp() {
        $this->types['application/x-httpd-php'] = 'application/x-httpd-php';
    }

    function addPhp3() {
        $this->types['application/x-httpd-php'] = 'application/x-httpd-php';
    }

    function addPhp4() {
        $this->types['application/x-httpd-php'] = 'application/x-httpd-php';
    }

    function addPhp5() {
        $this->types['application/x-httpd-php'] = 'application/x-httpd-php';
    }

    function addPhps() {
        $this->types['application/x-httpd-php-source'] = 'application/x-httpd-php-source';
    }

    function addPhtml() {
        $this->types['application/x-httpd-php'] = 'application/x-httpd-php';
    }

    function addPl() {
        $this->types['text/x-perl'] = 'text/x-perl';
    }

    function addPm() {
        $this->types['text/x-perl'] = 'text/x-perl';
    }

    function addPng() {
        $this->types['image/png']   = 'image/png';
        $this->types['image/x-png'] = 'image/x-png';
    }

    function addPo() {
        $this->types['text/x-gettext-translation'] = 'text/x-gettext-translation';
    }

    function addPot() {
        $this->types['application/vnd.ms-powerpoint'] = 'application/vnd.ms-powerpoint';
    }

    function addPps() {
        $this->types['application/vnd.ms-powerpoint'] = 'application/vnd.ms-powerpoint';
    }

    function addPpt() {
        $this->types['application/powerpoint'] = 'application/powerpoint';
    }

    function addPptx() {
        $this->types['application/vnd.openxmlformats-officedocument.presentationml.presentation'] = 'application/vnd.openxmlformats-officedocument.presentationml.presentation';
    }

    function addPs() {
        $this->types['application/postscript'] = 'application/postscript';
    }

    function addPsd() {
        $this->types['application/x-photoshop'] = 'application/x-photoshop';
        $this->types['image/x-photoshop']       = 'image/x-photoshop';
    }

    function addPub() {
        $this->types['application/x-mspublisher'] = 'application/x-mspublisher';
    }

    function addPy() {
        $this->types['text/x-python'] = 'text/x-python';
    }

    function addQt() {
        $this->types['video/quicktime'] = 'video/quicktime';
    }

    function addRa() {
        $this->types['audio/x-realaudio'] = 'audio/x-realaudio';
    }

    function addRam() {
        $this->types['audio/x-realaudio']    = 'audio/x-realaudio';
        $this->types['audio/x-pn-realaudio'] = 'audio/x-pn-realaudio';
    }

    function addRar() {
        $this->types['application/rar'] = 'application/rar';
    }

    function addRgb() {
        $this->types['image/x-rgb'] = 'image/x-rgb';
    }

    function addRm() {
        $this->types['audio/x-pn-realaudio'] = 'audio/x-pn-realaudio';
    }

    function addRpm() {
        $this->types['audio/x-pn-realaudio-plugin']          = 'audio/x-pn-realaudio-plugin';
        $this->types['application/x-redhat-package-manager'] = 'application/x-redhat-package-manager';
    }

    function addRss() {
        $this->types['application/rss+xml'] = 'application/rss+xml';
    }

    function addRtf() {
        $this->types['text/rtf'] = 'text/rtf';
    }

    function addRtx() {
        $this->types['text/richtext'] = 'text/richtext';
    }

    function addRv() {
        $this->types['video/vnd.rn-realvideo'] = 'video/vnd.rn-realvideo';
    }

    function addSea() {
        $this->types['application/octet-stream'] = 'application/octet-stream';
    }

    function addSh() {
        $this->types['text/x-sh'] = 'text/x-sh';
    }

    function addShtml() {
        $this->types['text/html'] = 'text/html';
    }

    function addSit() {
        $this->types['application/x-stuffit'] = 'application/x-stuffit';
    }

    function addSmi() {
        $this->types['application/smil'] = 'application/smil';
    }

    function addSmil() {
        $this->types['application/smil'] = 'application/smil';
    }

    function addSo() {
        $this->types['application/octet-stream'] = 'application/octet-stream';
    }

    function addSrc() {
        $this->types['application/x-wais-source'] = 'application/x-wais-source';
    }

    function addSvg() {
        $this->types['image/svg+xml'] = 'image/svg+xml';
    }

    function addSwf() {
        $this->types['application/x-shockwave-flash'] = 'application/x-shockwave-flash';
    }

    function addT() {
        $this->types['application/x-troff'] = 'application/x-troff';
    }

    function addTar() {
        $this->types['application/x-tar'] = 'application/x-tar';
    }

    function addTcl() {
        $this->types['text/x-tcl'] = 'text/x-tcl';
    }

    function addTex() {
        $this->types['application/x-tex'] = 'application/x-tex';
    }

    function addText() {
        $this->types['text/plain'] = 'text/plain';
    }

    function addTexti() {
        $this->types['application/x-texinfo'] = 'application/x-texinfo';
    }

    function addTextinfo() {
        $this->types['application/x-texinfo'] = 'application/x-texinfo';
    }

    function addTgz() {
        $this->types['application/x-tar'] = 'application/x-tar';
    }

    function addTif() {
        $this->types['image/tiff'] = 'image/tiff';
    }

    function addTiff() {
        $this->types['image/tiff'] = 'image/tiff';
    }

    function addTorrent() {
        $this->types['application/x-bittorrent'] = 'application/x-bittorrent';
    }

    function addTr() {
        $this->types['application/x-troff'] = 'application/x-troff';
    }

    function addTsv() {
        $this->types['text/tab-separated-values'] = 'text/tab-separated-values';
    }

    function addTxt() {
        $this->types['text/plain'] = 'text/plain';
    }

    function addWav() {
        $this->types['audio/x-wav'] = 'audio/x-wav';
    }

    function addWax() {
        $this->types['audio/x-ms-wax'] = 'audio/x-ms-wax';
    }

    function addWbxml() {
        $this->types['application/wbxml'] = 'application/wbxml';
    }

    function addWebapp() {
        $this->types['application/x-web-app-manifest+json'] = 'application/x-web-app-manifest+json';
    }

    function addWebm() {
        $this->types['video/webm'] = 'video/webm';
    }

    function addWm() {
        $this->types['video/x-ms-wm'] = 'video/x-ms-wm';
    }

    function addWma() {
        $this->types['audio/x-ms-wma'] = 'audio/x-ms-wma';
    }

    function addWmd() {
        $this->types['application/x-ms-wmd'] = 'application/x-ms-wmd';
    }

    function addWmlc() {
        $this->types['application/wmlc'] = 'application/wmlc';
    }

    function addWmv() {
        $this->types['video/x-ms-wmv']           = 'video/x-ms-wmv';
        $this->types['application/octet-stream'] = 'application/octet-stream';
    }

    function addWmx() {
        $this->types['video/x-ms-wmx'] = 'video/x-ms-wmx';
    }

    function addWmz() {
        $this->types['application/x-ms-wmz'] = 'application/x-ms-wmz';
    }

    function addWord() {
        $this->types['application/msword']       = 'application/msword';
        $this->types['application/octet-stream'] = 'application/octet-stream';
    }

    function addWp5() {
        $this->types['application/wordperfect5.1'] = 'application/wordperfect5.1';
    }

    function addWpd() {
        $this->types['application/vnd.wordperfect'] = 'application/vnd.wordperfect';
    }

    function addWvx() {
        $this->types['video/x-ms-wvx'] = 'video/x-ms-wvx';
    }

    function addXbm() {
        $this->types['image/x-xbitmap'] = 'image/x-xbitmap';
    }

    function addXcf() {
        $this->types['image/xcf'] = 'image/xcf';
    }

    function addXhtml() {
        $this->types['application/xhtml+xml'] = 'application/xhtml+xml';
    }

    function addXht() {
        $this->types['application/xhtml+xml'] = 'application/xhtml+xml';
    }

    function addXl() {
        $this->types['application/excel']        = 'application/excel';
        $this->types['application/vnd.ms-excel'] = 'application/vnd.ms-excel';
    }

    function addXla() {
        $this->types['application/excel']        = 'application/excel';
        $this->types['application/vnd.ms-excel'] = 'application/vnd.ms-excel';
    }

    function addXlc() {
        $this->types['application/excel']        = 'application/excel';
        $this->types['application/vnd.ms-excel'] = 'application/vnd.ms-excel';
    }

    function addXlm() {
        $this->types['application/excel']        = 'application/excel';
        $this->types['application/vnd.ms-excel'] = 'application/vnd.ms-excel';
    }

    function addXls() {
        $this->types['application/excel']        = 'application/excel';
        $this->types['application/vnd.ms-excel'] = 'application/vnd.ms-excel';
    }

    function addXlsx() {
        $this->types['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'] = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
    }

    function addXlt() {
        $this->types['application/excel']        = 'application/excel';
        $this->types['application/vnd.ms-excel'] = 'application/vnd.ms-excel';
    }

    function addXml() {
        $this->types['text/xml']        = 'text/xml';
        $this->types['application/xml'] = 'application/xml';
    }

    function addXof() {
        $this->types['x-world/x-vrml'] = 'x-world/x-vrml';
    }

    function addXpm() {
        $this->types['image/x-xpixmap'] = 'image/x-xpixmap';
    }

    function addXsl() {
        $this->types['text/xml'] = 'text/xml';
    }

    function addXvid() {
        $this->types['video/x-xvid'] = 'video/x-xvid';
    }

    function addXwd() {
        $this->types['image/x-xwindowdump'] = 'image/x-xwindowdump';
    }

    function addZ() {
        $this->types['application/x-compress'] = 'application/x-compress';
    }

    function addZip() {
        $this->types['application/x-zip']            = 'application/x-zip';
        $this->types['application/zip']              = 'application/zip';
        $this->types['application/x-zip-compressed'] = 'application/x-zip-compressed';
    }

}