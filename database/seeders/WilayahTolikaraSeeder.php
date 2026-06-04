<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Distrik;
use App\Models\Kelurahan;
use App\Models\Kampung;

class WilayahTolikaraSeeder extends Seeder
{
    public function run(): void
    {
        $wilayah = [
            ['kode'=>'95.04.01','nama'=>'Karubaga','ibu_kota'=>'Karubaga','kelurahan'=>['Karubaga'],'kampung'=>['Ampera','Beleme','Danggulurik','Ebenhaiser','Elsadai','Gininggadona','Gurikagewa','Gurikme','Kimobur','Kiranage','Kogimagi','Kolilan','Kuloname','Kuragepura','Lirak','Losmen','Luwik','Molera','Muara','Nalorini','Pulanggun','Yalikaluk']],
            ['kode'=>'95.04.02','nama'=>'Bokondini','ibu_kota'=>'Bokondini','kelurahan'=>['Bokondini'],'kampung'=>['Apiam','Dunduma','Galala','Jawalane','Kologume','Lambogo','Mairini','Minggangg','Tenggagama','Umaga']],
            ['kode'=>'95.04.03','nama'=>'Kanggime','ibu_kota'=>'Kanggime','kelurahan'=>['Kanggime'],'kampung'=>['Aulani','Dundu','Kagimaluk','Kerena','Lawor','Ligiibak','Logon','Marlo','Purugi']],
            ['kode'=>'95.04.04','nama'=>'Kembu','ibu_kota'=>'Kembu','kelurahan'=>['Kembu'],'kampung'=>['Agimdek','Aworera','Genani','Kabori','Kobon','Mamit','Nugari','Tioga','Wulinaga','Yowo']],
            ['kode'=>'95.04.05','nama'=>'Goyage','ibu_kota'=>'Goyage','kelurahan'=>[],'kampung'=>['Angkasa','Benari','Bini','Bopa','Didelonik','Doge','Dugi','Gilok','Goyage','Kumbu','Mampulaga','Peko','Tidur Mabuk','Tigikun','Tigir','Tiri','Wijamurik','Woji','Yemarima']],
            ['kode'=>'95.04.06','nama'=>'Wunim','ibu_kota'=>'Wurineri','kelurahan'=>[],'kampung'=>['Arombuk','Enana','Gilopaga','Keribaga','Numbuboton','Pindak','Pokegi','Wona','Wurineri']],
            ['kode'=>'95.04.07','nama'=>'Wina','ibu_kota'=>'Wina','kelurahan'=>[],'kampung'=>['Akima','Bimbogul','Finai','Gualo','Holandia','Malela','Nakwil','Tawi','Wariru','Wina','Yogweme','Yugubuk','Yugumengga']],
            ['kode'=>'95.04.08','nama'=>'Umagi','ibu_kota'=>'Umagi','kelurahan'=>[],'kampung'=>['Gatini','Gurin','Mino','Nambu','Nolopur','Pagongga','Piriluk','Popaga','Umagi','Warna','Yaleme','Yali']],
            ['kode'=>'95.04.09','nama'=>'Panaga','ibu_kota'=>'Panaga','kelurahan'=>[],'kampung'=>['Eragani','Ibunuh','Kutiom','Paido','Panaga','Pindanggun','Saksi Maler','Siak','Yandono']],
            ['kode'=>'95.04.10','nama'=>'Woniki','ibu_kota'=>'Wilileme','kelurahan'=>[],'kampung'=>['Bugum','Lugwi','Mome','Pagona','Teropme','Wilileme','Wunabu','Yaliwak','Yangguni','Yigonime']],
            ['kode'=>'95.04.11','nama'=>'Kubu','ibu_kota'=>'Kubu','kelurahan'=>[],'kampung'=>['Aruku','Kalewi','Kubu','Kubugiwa','Menggena','Minagi','Murik','Numbugawe','Tiyenggupur']],
            ['kode'=>'95.04.12','nama'=>'Kondaga','ibu_kota'=>'Konda','kelurahan'=>[],'kampung'=>['Arikoba','Arulo','Arumagi','Ganage','Gimo','Konda','Mandura','Mowilome','Silabulo','Tingapura','Yawineri']],
            ['kode'=>'95.04.13','nama'=>'Nelawi','ibu_kota'=>'Nelawi','kelurahan'=>[],'kampung'=>['Barename','Kendemaya','Megapura','Minagame','Mondagul','Nelawi','Palagi','Tabowanimbo','Timojimo','Wabuna','Woromolome','Yilogonime']],
            ['kode'=>'95.04.14','nama'=>'Kuari','ibu_kota'=>'Kuari','kelurahan'=>[],'kampung'=>['Abepur','Alopur','Baliminggi','Gubagi','Jinulira','Kenen','Kibur','Kondegun','Kuari','Kurik','Luanggi','Markar','Menggeba','Menggenagame','Tebenalo','Umaga','Wanggugup']],
            ['kode'=>'95.04.15','nama'=>'Bokoneri','ibu_kota'=>'Bokoneri','kelurahan'=>[],'kampung'=>['Abimbak','Bokoneri','Bolly','Dongem','Durima','Kanere','Kanewunuk','Kurewunuk','Lerewere','Munagame','Nanggurilime','Nunggalo','Omuk','Tanabume','Waringga','Weri','Wonaga']],
            ['kode'=>'95.04.16','nama'=>'Bewani','ibu_kota'=>'Bilubaga','kelurahan'=>[],'kampung'=>['Abena','Arelam','Bilubaga','Bitilabur','Duma','Gabunggobak','Gelalo','Nogobumbu','Wanggulem','Wania','Windik','Wulurik','Yibalo','Yinama']],
            ['kode'=>'95.04.17','nama'=>'Nabunage','ibu_kota'=>'Nabunage','kelurahan'=>[],'kampung'=>['Geningga','Jekito','Kimilo','Kumbo','Kupara','Kutime','Logilome','Missa','Nabunage','Timbindelo','Wewo']],
            ['kode'=>'95.04.18','nama'=>'Gilubandu','ibu_kota'=>'Tinggom','kelurahan'=>[],'kampung'=>['Baguni','Egoni','Kulutin','Lerewere','Martelo','Orelukban','Tinggom','Welesi','Yakep','Yamulo']],
            ['kode'=>'95.04.19','nama'=>'Nunggawi','ibu_kota'=>'Nunggawi','kelurahan'=>[],'kampung'=>['Barenggo','Belep','Delelah','Derek','Gilo','Kabumanggen','Kanggineri','Kilungga','Kimobur','Kipino','Kokondao','Kondangwi','Kubalo','Kunipaga','Kuripaga','Mololowa','Nombori','Numbe','Nunggawi','Tinoweno','Tomobur','Tunibur','Undi','Wondame','Wonoluk','Woyi']],
            ['kode'=>'95.04.20','nama'=>'Gundagi','ibu_kota'=>'Woraga','kelurahan'=>[],'kampung'=>['Aworera','Enggawogo','Gingga','Gubuk','Gumbini','Kalarin','Kurik','Muruneri','Nangga','Oker','Punggelak','Umar','Wamili','Wamolo','Winengga','Wobe','Woraga']],
            ['kode'=>'95.04.21','nama'=>'Numba','ibu_kota'=>'Numba','kelurahan'=>[],'kampung'=>['Baliminggi','Guniki','Jinuwanu','Keragigelok','Kuma','Numba','Tingwineri','Yalogo','Yiragame','Yugumena']],
            ['kode'=>'95.04.22','nama'=>'Timori','ibu_kota'=>'Bolubur','kelurahan'=>[],'kampung'=>['Bawi','Beremo','Bolubur','Eragani','Geneluk','Koinggambu','Liwina','Logulo','Luki','Pirage','Tioner','Tirib']],
            ['kode'=>'95.04.23','nama'=>'Dundu','ibu_kota'=>'Dundu','kelurahan'=>[],'kampung'=>['Bimo','Dugunagep','Dundu','Kembu','Kurupu','Nakwi','Nilogabu','Nini','Nugini','Yiku']],
            ['kode'=>'95.04.24','nama'=>'Geya','ibu_kota'=>'Geya','kelurahan'=>[],'kampung'=>['Alobaga','Dimbara','Geya','Jelepele','Kibu','Nawu','Timori','Tinagoga','Weyambi','Winalo','Witipur','Wungilipur']],
            ['kode'=>'95.04.25','nama'=>'Egiam','ibu_kota'=>'Egiam','kelurahan'=>[],'kampung'=>['Egiam','Kaliundi','Kurba','Murni','Pinde','Tabonakme','Wayongga','Weri','Yoka','Yonira']],
            ['kode'=>'95.04.26','nama'=>'Poganeri','ibu_kota'=>'Bogokila','kelurahan'=>[],'kampung'=>['Bogokila','Gagulineri','Genage','Gindugunik','Konengga','Kuoklangguni','Mabuk','Nogari','Telekonok','Tigir']],
            ['kode'=>'95.04.27','nama'=>'Kamboneri','ibu_kota'=>'Berembanak','kelurahan'=>[],'kampung'=>['Berembanak','Habag','Kaloniki','Kamboniki','Kekoli','Malta','Marbuna','Tari']],
            ['kode'=>'95.04.28','nama'=>'Airgaram','ibu_kota'=>'Onggokme','kelurahan'=>[],'kampung'=>['Kubur','Lenggup','Liwese','Onggokme','Tabo Wanimbo','Tinger','Wenduri','Weu']],
            ['kode'=>'95.04.29','nama'=>'Wari/Taiyeve II','ibu_kota'=>'Wari/Taiyeve','kelurahan'=>[],'kampung'=>['Arebe','Beleise','Dorera','Dotori','Dustra','Friji','Kalibu','Kowari','Kuruku','Laniloma','Muna','Papedari','Timoga','Wakumendek','Wari','Wiki','Yanora']],
            ['kode'=>'95.04.30','nama'=>'Dow','ibu_kota'=>'Dow/Bijere','kelurahan'=>[],'kampung'=>['Bire','Dagari','Dow','Itoli','Pakare','Prawa','Sigou','Takri','Tigu','Vokuyo','Warka']],
            ['kode'=>'95.04.31','nama'=>'Tagineri','ibu_kota'=>'Tagi','kelurahan'=>[],'kampung'=>['Bini','Dunda','Getiem','Lamaluk','Logi','Rumbepaga','Silo','Tagi','Wanuk','Yimabnime']],
            ['kode'=>'95.04.32','nama'=>'Yuneri','ibu_kota'=>'Yuneri','kelurahan'=>[],'kampung'=>['Gembileme','Kanggilo','Mopi','Omibur','Tenabaga','Umar','Wenome','Wonabunggame','Yido','Yudimba','Yuneri']],
            ['kode'=>'95.04.33','nama'=>'Wakuwo','ibu_kota'=>'Wonitu','kelurahan'=>[],'kampung'=>['Golena','Gulak','Gunalo','Korlo','Kumbur','Kwarini','Nowo','Timer','Towolome','Wama','Weyage','Wonitu']],
            ['kode'=>'95.04.34','nama'=>'Gika','ibu_kota'=>'Geka','kelurahan'=>[],'kampung'=>['Dimbara','Geka','Gelok','Kwa','Makido','Membramonggen','Tabunakme','Wanuwi','Wenigi','Yinuwanu']],
            ['kode'=>'95.04.35','nama'=>'Telenggeme','ibu_kota'=>'Telenggeme','kelurahan'=>[],'kampung'=>['Aukuni','Dolunggung','Kagi','Kimugu','Kimunuk','Linggira','Telenggeme','Tenekwe','Karu','Yagagobak']],
            ['kode'=>'95.04.36','nama'=>'Anawi','ibu_kota'=>'Anawi','kelurahan'=>[],'kampung'=>['Anawi','Aridunda','Bieleme','Gineri','Imurik','Kotori','Linggira','Loguk','Yalipura','Yalokobak']],
            ['kode'=>'95.04.37','nama'=>'Wenam','ibu_kota'=>'Banggeri','kelurahan'=>[],'kampung'=>['Baganagapur','Banggeri','Geyaneri','Igari','Kopenawai','Mili','Milineri','Telelomi','Tina','Wunggi']],
            ['kode'=>'95.04.38','nama'=>'Wugi','ibu_kota'=>'Wugi','kelurahan'=>[],'kampung'=>['Buangludah','Gilime','Gitar','Koli','Kuagembu','Lena','Loma','Pindelo','Timoneri','Wugi','Wuronggi']],
            ['kode'=>'95.04.39','nama'=>'Danime','ibu_kota'=>'Wania','kelurahan'=>[],'kampung'=>['Ambena','Bumbu','Delegari','Gunombo','Mawi','Milipaa','Niagale','Ripa','Tarawi','Wania']],
            ['kode'=>'95.04.40','nama'=>'Tagime','ibu_kota'=>'Peyola','kelurahan'=>[],'kampung'=>['Belela','Ekoni','Gabunam','Gulak','Kandimbaga','Kinebe','Kogotim','Melaga','Minggen','Peyola']],
            ['kode'=>'95.04.41','nama'=>'Kai','ibu_kota'=>'Kaiga','kelurahan'=>[],'kampung'=>['Again','Bawi','Kaiga','Kotorambu','Kurbaya','Piraleme','Tina','Tunggunale','Wiyangger','Wolu']],
            ['kode'=>'95.04.42','nama'=>'Aweku','ibu_kota'=>'Wuluk','kelurahan'=>[],'kampung'=>['Agin','Kogagi','Kolanggun','Posman','Tiyonggi','Wamigi','Wenggung','Wuluk','Yebena','Yelly']],
            ['kode'=>'95.04.43','nama'=>'Bogonuk','ibu_kota'=>'Bogonuk','kelurahan'=>[],'kampung'=>['Aliduda','Anglomak','Bogonuk','Ewan','Laura','Paba','Talinamber','Walelo','Wisman','Wumelak']],
            ['kode'=>'95.04.44','nama'=>'Li Anogomma','ibu_kota'=>'Lubuk','kelurahan'=>[],'kampung'=>['Aburage','Bogome','Erimbur','Gubura','Kogoyapura','Leragawi','Longgoboma','Lubuk','Tingwi','Wiyaluk']],
            ['kode'=>'95.04.45','nama'=>'Biuk','ibu_kota'=>'Biuk','kelurahan'=>[],'kampung'=>['Biuk','Galubup','Guburini','Mbinime','Purugi','Tomagi','Tomagipura','Wonabu','Yiluk','Yiyogobak','Yugu Mabur']],
            ['kode'=>'95.04.46','nama'=>'Yuko','ibu_kota'=>'Pekaleme','kelurahan'=>[],'kampung'=>['Ambirik','Giko','Gwak Dugunik','Karu','Kotorambu','Kungge','Minegimen','Miyanagame','Pekaleme','Tabuh','Teleme']],
        ];

        foreach ($wilayah as $w) {
            $distrik = Distrik::create([
                'kode'     => $w['kode'],
                'nama'     => $w['nama'],
                'ibu_kota' => $w['ibu_kota'],
            ]);

            foreach ($w['kelurahan'] as $kel) {
                Kelurahan::create([
                    'distrik_id' => $distrik->id,
                    'nama'       => $kel,
                ]);
            }

            foreach ($w['kampung'] as $kamp) {
                Kampung::create([
                    'distrik_id' => $distrik->id,
                    'nama'       => $kamp,
                ]);
            }
        }

        echo "Selesai! 46 Distrik, 4 Kelurahan, 541 Kampung berhasil dimasukkan!\n";
    }
}
