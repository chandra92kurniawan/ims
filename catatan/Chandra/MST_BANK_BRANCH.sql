-- SQL Loader Control and Data File created by TOAD
-- Variable length, terminated enclosed data formatting
-- 
-- The format for executing this file with SQL Loader is:
-- SQLLDR control=<filename> Be sure to substitute your
-- version of SQL LOADER and the filename for this file.
--
-- Note: Nested table datatypes are not supported here and
--       will be exported as nulls.
LOAD DATA
INFILE *
BADFILE './MST_BANK_BRANCH.BAD'
DISCARDFILE './MST_BANK_BRANCH.DSC'
APPEND INTO TABLE ADMSIB.MST_BANK_BRANCH
Fields terminated by ";" Optionally enclosed by '"'
(
  ID_BANK,
  ID_BANK_BRANCH,
  NAME_BANK,
  ADDRESS_BANK,
  WILAYAH NULLIF (WILAYAH="NULL"),
  CREATED_BY,
  CREATED_DATE DATE "MM/DD/YYYY HH24:MI:SS" NULLIF (CREATED_DATE="NULL"),
  MODIFY_BY,
  MODIFY_DATE DATE "MM/DD/YYYY HH24:MI:SS" NULLIF (MODIFY_DATE="NULL")
)
BEGINDATA
"0001";"9999";"N/A";"";0;"";NULL;"";NULL
"0001";"0000";"KANTOR PUSAT OPERASI";"Jl. Braga No.12 Kota Bandung - 40111";0;"";NULL;"";NULL
"0001";"0001";"CABANG UTAMA BANDUNG";"Jl. Braga No.12 Kota Bandung - 40111";1;"";NULL;"";NULL
"0001";"0002";"CABANG CIREBON";"Jl. Siliwangi No.30  Cirebon - 45123";3;"";NULL;"";NULL
"0001";"0003";"CABANG KARAWANG";"Jl.Kertabumi No.2 Kab.Karawang -41311";1;"";NULL;"";NULL
"0001";"0004";"CABANG CIAMIS";"Jl. Jend.Sudirman No.71 Kab. Ciamis - 46211";3;"";NULL;"";NULL
"0001";"0005";"CABANG TASIKMALAYA";"Jl. Mayor Utarya No.30 Tasikmalaya - 46113";3;"";NULL;"";NULL
"0001";"0006";"CABANG SUKABUMI";"Jl. Jend. A. Yani No. 35 A-37  Kota Sukabumi";1;"";NULL;"";NULL
"0001";"0008";"CABANG SUBANG";"Jl. Jend.A.Yani No.2  Kab. Subang - 41212";1;"";NULL;"";NULL
"0001";"0009";"CABANG INDRAMAYU";"Jl. Jend. Sudirman No. 106  Kabupaten  Indramayu";3;"";NULL;"";NULL
"0001";"0010";"CABANG BEKASI";"Bank DEVISA Jl. Ir.H. Djuanda No.126 Bekasi- 17113";2;"";NULL;"";NULL
"0001";"0011";"CABANG SUMEDANG";"Jl. Prabu Geusan Ulun No.89 Kab. Sumedang - 45312";3;"";NULL;"";NULL
"0001";"0013";"CABANG BOGOR";"Jl. Kapten Muslihat No.11-13  Kota Bogor - 16121";2;"";NULL;"";NULL
"0001";"0014";"CABANG CIANJUR";"Jl. HOS. Cokroaminoto No.56 A Kel. Muka,  Kec. Cianjur Kab. Cianjur - 43215";3;"";NULL;"";NULL
"0001";"0015";"CABANG KUNINGAN";"Jl. Siliwangi  Cigembang-Kab. Kuningan 45511";3;"";NULL;"";NULL
"0001";"0016";"CABANG MAJALENGKA";"Jl.K.H Abdul Halim No.224 Kab.Majalengka - 45418";3;"";NULL;"";NULL
"0001";"0017";"CABANG GARUT";"Jl. Jend. A.Yani No.38  Kab. Garut - 44117";3;"";NULL;"";NULL
"0001";"0018";"CABANG PURWAKARTA";"Jl Jendral Sudirman No. 63-64  Kab. Purwakarta - 41114";1;"";NULL;"";NULL
"0001";"0020";"CABANG LABUAN";"Jl. Jend.Sudirman No.182   Labuan 42264 Prov. Banten";4;"";NULL;"";NULL
"0001";"0021";"CABANG PANDEGLANG";"Jl. Mayor Widagdo No.6  Kab. Pandeglang 42212 Prov. Banten";4;"";NULL;"";NULL
"0001";"0022";"CABANG SOREANG";"Jl. Raya Soreang Km 17  Depan Kantor Pemda Kab. Bandung  Soreang";1;"";NULL;"";NULL
"0001";"0023";"CABANG CIMAHI";"Jl. Jend. H. Amir Machmud No. 451 Kota Cimahi  - 40524";1;"";NULL;"";NULL
"0001";"0024";"CABANG SUCI";"Jl. P.H.H. Mustopa No.66  Kota Bandung - 40124";1;"";NULL;"";NULL
"0001";"0025";"CABANG DEPOK";"Jl. Margonda Raya No.29  Kota Depok - 16432";2;"";NULL;"";NULL
"0001";"0026";"CABANG CIKARANG";"Jl.Yos Sudarso No.91-93  Cikarang Plaza  Kec. Cikarang Utara Kab. Bekasi";2;"";NULL;"";NULL
"0001";"0027";"CABANG TAMANSARI";"Jl. Tamansari No. 18  Kota Bandung";1;"";NULL;"";NULL
"0001";"0031";"CABANG SUMBER";"Jl. Sultan Agung No. 3  Blok Pon Kel. Sumber Kec. Sumber  Kab. Cirebon - 45611";3;"";NULL;"";NULL
"0001";"0034";"CABANG RAWAMANGUN";"Jl. Pemuda No. 97 Kec. Pulogadung - Jakarta Timur";2;"";NULL;"";NULL
"0001";"0036";"CABANG BANJAR";"Jl. Letjen Suwarto No. 4  Kel. Hegarsari Kec. Pataruman Kota Banjar";3;"";NULL;"";NULL
"0001";"0048";"CABANG CIBINONG";"Komplek Perkantoran Pemda Kab Bogor Jl. Tegar Beriman - Cibinong Kabupaten Bogor  16914";2;"";NULL;"";NULL
"0001";"0052";"CABANG PELABUHAN RATU";"Jl. Siliwangi No. 41  Palabuhanratu 43364 Kabupaten Sukabumi";1;"";NULL;"";NULL
"0001";"0056";"KC SYARIAH BANDUNG";"";1;"";NULL;"";NULL
"0001";"0062";"CABANG BALARAJA";"Jl. Raya Serang km22.5 Kadiwaran-Cikupa  Kabupaten Tangerang - Banten";4;"";NULL;"";NULL
"0001";"0078";"CABANG MAJALAYA";"Ruko Sentra Niaga Permata Majalaya Jl. Tengah No. 3 - 6 Majalaya  Kabupaten Bandung";1;"";NULL;"";NULL
"0001";"0080";"CABANG BUAH BATU";"Jl. Buahbatu No.254  Kota Bandung";1;"";NULL;"";NULL
"0001";"0087";"SYARIAH TASIKMALAYA";"";1;"";NULL;"";NULL
"0001";"0088";"SYARIAH CIREBON";"";1;"";NULL;"";NULL
"0001";"0089";"SYARIAH BOGOR";"";1;"";NULL;"";NULL
"0001";"0096";"SYARIAH SERANG";"";1;"";NULL;"";NULL
"0001";"0098";"CABANG SINGAPARNA";"";1;"";NULL;"";NULL
"0001";"0114";"CABANG SUKAJADI";"Bank DEVISA  Jl. Sukajadi No. 216  Kota Bandung 40161";1;"";NULL;"";NULL
"0001";"0136";"CABANG KEBAYORAN BARU";"Graha Iskandarsyah Lt. 2  JL. Iskandarsyah Raya no. 66 C  Kebayoran Baru 12160 - Jakarta Selatan";2;"";NULL;"";NULL
"0001";"0162";"SYARIAH BEKASI";"";2;"";NULL;"";NULL
"0001";"0167";"CABANG SURABAYA";"Jl. Raya Darmo No. 87  Surabaya Jawa Timur";3;"";NULL;"";NULL
"0001";"0170";"CABANG SEMARANG";"Jl.Ahmad Yani No.174 Semarang- Jawa Tengah";3;"";NULL;"";NULL
"0001";"0182";"CABANG BSD SERPONG";"Jl. Letnan Sutopo Komp. Bumi Serpong Damai (BSD) III B-1 Blok E No. 01-B Serpong Kota Tangerang Selatan";4;"";NULL;"";NULL
"0001";"0211";"CABANG MANGGA DUA/GAJAH MADA";"Jl. Gajah Mada No.86 A-B  Kel.Krukut Kec.Taman sari Jakarta Barat";2;"";NULL;"";NULL
"0001";"0240";"CABANG MEDAN";"Jl.Suwondo Parman No.1 Medan Kec.Medan Baru Kota Medan Prov.Sumatera Utara";4;"";NULL;"";NULL
"0001";"0241";"CABANG BATAM";"JL.Engku Putri No.08 Komplek.Batam Centre Square Blok D No.01 Kel.Teluk Tering  Kec.Batam Kota Batam 29421";4;"";NULL;"";NULL
"0001";"0279";"CABANG MAKASSAR";"Jl.Jendral Sudirman No.54 B Kota Makassar";2;"";NULL;"";NULL
"0001";"0280";"CABANG BALIKPAPAN";"Jl.Jenderal Sudirman No.15 RT.06 Kel.Damai  Kota Balikpapan  Kalimantan Timur";2;"";NULL;"";NULL
"0001";"0281";"CABANG PEKANBARU";"Jl.Jenderal Sudirman No.391 C Kota Pekanbaru";4;"";NULL;"";NULL
"0001";"0308";"CABANG HASYIM ASHARI";"Jl. K.H Hasyim Ashari No.34 Kec.Gambir  Jakarta Pusat";2;"";NULL;"";NULL
"0001";"0309";"CABANG TEGAL";"Jl.Mayor Jendral Sutoyo No.32 Kota Tegal  Jawa Tengah";3;"";NULL;"";NULL
"0001";"0310";"CABANG DENPASAR";"Jl.Jenderal Teuku Umar No.69 Simpang Enam Kota Denpasar Prov.Bali";2;"";NULL;"";NULL
"0001";"0371";"CABANG BANDAR LAMPUNG";"Jl.Raden Intan no.81 A Kel.Enggal Kec.Tanjung Karang Pusat  Bandar Lampung";4;"";NULL;"";NULL
"0001";"0372";"CABANG SURAKARTA";"Jl.Slamet Riyadi No.135-137 Kel.Kemlayan Kec.Serangan Surakarta";3;"";NULL;"";NULL
"0001";"0391";"CABANG PALEMBANG";"Jl.Sudirman Km.3.5 Kel.20 Ilir Kec.Ilir Timur I  Palembang";4;"";NULL;"";NULL
"0001";"0393";"CABANG BANJARMASIN";"Jl.Ahmad Yani Km.3 RT.2 Kel.Kebun Bunga Kec.Banjarmasin Timur Kota Banjarmasin";2;"";NULL;"";NULL
"0001";"0402";"CABANG DAAN MOGOT";"";2;"";NULL;"";NULL
"0001";"0403";"CABANG JATINANGOR";"Jl. Raya jatinangor No.41 Kab.Sumedang";1;"";NULL;"";NULL
"0001";"0404";"CABANG RASUNA SAID";"";1;"";NULL;"";NULL
"0001";"0405";"CABANG S PARMAN";"";2;"";NULL;"";NULL
"0001";"0406";"CABANG SAHARJO";"Jl.Dokter Saharjo No.111 Kec.Tebet Jakarta Selatan";2;"";NULL;"";NULL
"0001";"0007";"CABANG KHUSUS BANTEN";"Jl. Veteran No. 6 Serang - 42117,  Provinsi Banten";4;"";NULL;"";NULL
"0001";"0012";"CABANG TANGERANG";"Bank DEVISA The Modern Golf Shop Houses No.9 Kel. Kelapa Indah,  Kec. Tangerang  Kota Tangerang - 15111";4;"";NULL;"";NULL
"0001";"0028";"CABANG CILEGON";"Jl. Ahmad Yani No. 132  Kel. Sukmajaya Kec. Jombang  Kota Cilegon 42411 Prov. Banten";4;"";NULL;"";NULL
"0001";"0074";"CABANG KHUSUS JAKARTA";"Bank DEVISA Jl.Jend.Sudirman Kav.2 Gedung Arthaloka Lt.Dasar & Lt.4  Jakarta Pusat";2;"";NULL;"";NULL
"0001";"0075";"CABANG PADALARANG";"Jl. Raya Purwakarta No. 75  Blok Sindang Palay - Ds Kertamulya  Kab. Bandung Barat";1;"";NULL;"";NULL
"0001";"0019";"CABANG RANGKASBITUNG";"JL. Patih Derus, No.4, Rangkasbitung, 42311";4;"";NULL;"";NULL
