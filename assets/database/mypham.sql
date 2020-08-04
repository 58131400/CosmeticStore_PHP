-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 26, 2019 lúc 11:45 AM
-- Phiên bản máy phục vụ: 10.1.25-MariaDB
-- Phiên bản PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `mypham`
--

DELIMITER $$
--
-- Thủ tục
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_soluongmua` (IN `idsp` VARCHAR(6))  NO SQL
SELECT SUM(soluong) FROM `chi_tiet_don_hang` WHERE masp = idsp GROUP by soluong$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_top_km` (IN `top` INT)  NO SQL
SELECT km.masp, tensp,hinh, km.muc_khuyen_mai from khuyen_mai as km JOIN san_pham as sp on km.masp = sp.Masp ORDER BY km.muc_khuyen_mai DESC limit top$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_top_mua` (IN `loaisp` VARCHAR(3), IN `top` INT)  NO SQL
SELECT ct.masp,SUM(ct.soluong),sp.tensp,hinh FROM `chi_tiet_don_hang` AS ct JOIN san_pham as sp ON ct.masp = sp.Masp WHERE ct.masp LIKE loaisp GROUP by ct.masp ORDER BY SUM(ct.soluong) DESC LIMIT top$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_don_hang`
--

CREATE TABLE `chi_tiet_don_hang` (
  `id` int(11) NOT NULL,
  `madon` varchar(6) NOT NULL,
  `masp` varchar(6) NOT NULL,
  `soluong` int(11) NOT NULL,
  `dongia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_don_hang`
--

INSERT INTO `chi_tiet_don_hang` (`id`, `madon`, `masp`, `soluong`, `dongia`) VALUES
(1, 'MD001', 'MP0001', 4, 800000),
(2, 'MD002', 'MP0002', 3, 105000),
(3, 'MD003', 'NH0001', 2, 800000),
(4, 'MD005', 'MP0005', 2, 380000),
(5, 'MD004', 'MP0004', 6, 1200000),
(6, 'MD007', 'MP0001', 3, 6000000),
(7, 'MD005', 'MP0003', 5, 8500000),
(8, 'MD008', 'NH0001', 1, 400000),
(9, 'MD006', 'TP0002', 2, 5400000),
(10, 'MD009', 'TP0004', 1, 5400000),
(11, 'MD010', 'MP0003', 2, 3400000),
(12, 'MD001', 'MP0015', 3, 3900000),
(13, 'MD007', 'NH0002', 2, 3600000),
(14, 'MD009', 'TP0010', 4, 5200000),
(15, 'MD010', 'MP0014', 2, 4900000),
(16, 'MD003', 'NH0006', 2, 2400000),
(26, 'MD011', 'MP0010', 1, 150000),
(27, 'MD011', 'MP0004', 1, 200000),
(28, 'MD012', 'MP0003', 1, 170000),
(29, 'MD012', 'MP0001', 1, 200000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `don_hang`
--

CREATE TABLE `don_hang` (
  `madon` varchar(6) NOT NULL,
  `ngaydathang` date NOT NULL,
  `tongtien` int(11) NOT NULL,
  `tinhtrang` tinyint(1) NOT NULL,
  `matk` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `don_hang`
--

INSERT INTO `don_hang` (`madon`, `ngaydathang`, `tongtien`, `tinhtrang`, `matk`) VALUES
('MD001', '2019-11-05', 500000, 0, 'TK001'),
('MD002', '2019-11-22', 1000000, 1, 'TK002'),
('MD003', '2019-11-08', 800000, 0, 'TK003'),
('MD004', '2019-11-01', 1200000, 1, 'TK004'),
('MD005', '2019-11-16', 900000, 1, 'TK005'),
('MD006', '2019-11-27', 800000, 1, 'TK006'),
('MD007', '2019-11-04', 1600000, 1, 'TK007'),
('MD008', '2019-11-05', 900000, 0, 'TK008'),
('MD009', '2019-11-30', 2000000, 0, 'TK009'),
('MD010', '2019-11-01', 4300000, 1, 'TK010'),
('MD011', '2019-11-25', 350000, 0, 'TK013'),
('MD012', '2019-11-26', 370000, 0, 'TK011');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khach_hang`
--

CREATE TABLE `khach_hang` (
  `makh` varchar(6) NOT NULL,
  `hoten` varchar(30) NOT NULL,
  `dienthoai` varchar(10) NOT NULL,
  `diachi` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `ghichu` varchar(50) DEFAULT NULL,
  `matk` varchar(6) DEFAULT NULL,
  `Hinh` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `khach_hang`
--

INSERT INTO `khach_hang` (`makh`, `hoten`, `dienthoai`, `diachi`, `email`, `ghichu`, `matk`, `Hinh`) VALUES
('KH001', 'Lê Thị Bích Hoa', '09873457', 'Nha Trang', 'lethibichhoa@gmail.com', '', 'TK001', 'anh1.jpg'),
('KH002', 'Mai Thanh Nguyên', '09125222', 'Hà Nội', 'maithanhnguyen@gmail.com', '', 'TK002', 'anh2.jpg'),
('KH003', 'Hoàng Văn Anh', '09567788', 'Đà Nẳng', 'hoangvananh@gmail.com', '', 'TK003', 'anh2.jpg'),
('KH004', 'Nguyễn Thị Hồng Hạnh', '07665544', 'TPHCM', 'nguyenthihonghanh@gmail.com', '', 'TK004', 'anh1.jpg'),
('KH005', 'Đào Thị Mai', '01266655', 'Quy Nhơn', 'daothimai@gmail.com', '', 'TK005', 'anh1.jpg'),
('KH006', 'Mai quỳnh anh', '07836239', 'Khanh Hoa', 'maiquynhanh@gmail.com', '', 'TK006', 'anh1.jpg'),
('KH007', 'Nguyễn Văn Thanh', '01692352', 'Khanh Hoa', 'nguyenvanthanh@gmail.com', '', 'TK007', 'anh2.jpg'),
('KH008', 'PhamTùng Phương', '05421972', 'Khanh Hoa', 'phamtungphuong@gmail.com', '', 'TK008', 'anh2.jpg'),
('KH009', 'Đỗ Mai Phương', '03457242', 'TPHCM', 'domaiphuong@gmail.com', '', 'TK009', 'anh1.jpg'),
('KH010', 'Phạm Hồng Hạnh', '02618725', 'Nha Trang', 'phamhonghanh@gmail.com', '', 'TK010', 'anh1.jpg'),
('KH011', 'thái', '0986604578', '1/16 đường 1c Nha trang, khánh hòa', 'xichlong.it@gmail.com', 'không', 'TK011', 'avatar.jpg'),
('KH012', 'thái', '0986604577', '1/16 đường 1c Nha trang, khánh hòa', 'xichlong.it@gmail.com', '1/16 đường 1c Nha trang, khánh hòa', 'TK012', 'user.png'),
('KH013', 'thái', '0986604577', '1/16 đường 1c Nha trang, khánh hòa', 'xichlong.it@gmail.com', 'không', 'TK013', 'user.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyen_mai`
--

CREATE TABLE `khuyen_mai` (
  `id` int(11) NOT NULL,
  `masp` varchar(6) NOT NULL,
  `muc_khuyen_mai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `khuyen_mai`
--

INSERT INTO `khuyen_mai` (`id`, `masp`, `muc_khuyen_mai`) VALUES
(1, 'MP0001', 25),
(2, 'NH0001', 15),
(3, 'MP0002', 5),
(5, 'MP0003', 13),
(6, 'MP0004', 10),
(7, 'MP0005', 45);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai_sp`
--

CREATE TABLE `loai_sp` (
  `MaLoai` varchar(6) NOT NULL,
  `tenloai` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `loai_sp`
--

INSERT INTO `loai_sp` (`MaLoai`, `tenloai`) VALUES
('MP01', 'Trang điểm'),
('MP02', 'Chăm sóc da'),
('NH01', 'Nước hoa nữ'),
('NH02', 'Nước hoa nam'),
('TP01', 'Thực phẩm chức năng người lớn'),
('TP02', 'Thực phẩm khác');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nha_san_xuat`
--

CREATE TABLE `nha_san_xuat` (
  `mansx` varchar(6) NOT NULL,
  `tennsx` varchar(30) NOT NULL,
  `diachi` varchar(50) NOT NULL,
  `quocgia` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `nha_san_xuat`
--

INSERT INTO `nha_san_xuat` (`mansx`, `tennsx`, `diachi`, `quocgia`) VALUES
('NSX001', 'Some By Me', 'Địa chỉ 1', 'Hàn Quốc'),
('NSX002', 'L’Oreal', 'Địa chỉ 2', 'Pháp'),
('NSX003', 'Unilever', 'Địa chỉ 3', 'Hà Lan'),
('NSX004', 'Shiseido Group', 'Địa chỉ 4', 'Nhật Bản'),
('NSX005', 'Coty', 'Địa chỉ 5', 'Mỹ'),
('NSX006', ' Innisfree', 'Địa chỉ 6', 'Hàn Quốc'),
('NSX007', 'Bioderma', 'Địa chỉ 7', 'Pháp'),
('NSX008', ' Maybelline', 'Địa chỉ 8', 'Mỹ'),
('NSX009', 'MAC', 'Địa chỉ 9', 'Mỹ'),
('NSX010', 'Lancome', 'Địa chỉ 10', 'Pháp');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `san_pham`
--

CREATE TABLE `san_pham` (
  `Masp` varchar(6) NOT NULL,
  `tensp` varchar(30) NOT NULL,
  `dongia` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `mota` varchar(100) NOT NULL,
  `hinh` varchar(30) NOT NULL,
  `maloai` varchar(6) NOT NULL,
  `mansx` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `san_pham`
--

INSERT INTO `san_pham` (`Masp`, `tensp`, `dongia`, `soluong`, `mota`, `hinh`, `maloai`, `mansx`) VALUES
('MP0001', 'MMamonde Creamy Tint Color Bal', 200000, 5, ' Phù hợp với tông da của phụ nữ châu Á, khả năng bám màu tốt, chất son nhẹ mượt', 'hinh1.jpg', 'MP01', 'NSX001'),
('MP0002', 'INNISFREE TRIPLE-CARE SPF 50', 350000, 6, ' Làn da tươi sáng và rạng rỡ với hiệu quả làm trắng của lá hoa đại anh đào từ đảo Jeju\r\nChiết xuất l', 'hinh3.jpg', 'MP02', 'NSX005'),
('MP0003', 'L\'Oreal Paris 3-in-1 Micellar ', 170000, 10, 'làm sạch, tẩy trang và bổ sung dưỡng chất giúp da mềm mại.', 'hinh5.jpg', 'MP02', 'NSX003'),
('MP0004', 'Kate Powderless Liquid', 200000, 9, 'ản phẩm có tone màu tự nhiên, kiềm dầu tốt và cực kỳ dễ đánh dù kỹ thuật bạn không được tốt', 'hinh6.jpg', 'MP01', 'NSX003'),
('MP0005', 'Vaseline Healthy White ', 190000, 3, 'một giải pháp hiệu quả đem lại cho bạn làn da trắng sáng và mịn màng, đã được kiểm nghiệm qua nhiều ', 'hinh7.jpg', 'MP01', 'NSX001'),
('MP0006', 'Set Son MAC Travel Exclusive P', 2200000, 2, 'chất son lì mịn như lụa, độ dưỡng mềm môi, khó lòng không mê', 'hinh23.jpg', 'MP01', 'NSX009'),
('MP0007', 'KEM LÓT (PRIMER)', 240000, 2, 'kem lót còn là bước nền tảng định tông màu cho da, làm mờ lỗ chân lông và các nếp nhăn.', 'hinh24.jpg', 'MP01', 'NSX003'),
('MP0008', 'KKEM CHE KHUYẾT ĐIỂM (CONCEALE', 400000, 1, 'kem che khuyết điểm sẽ giải quyết các nốt mụn, vết thâm và chuyên trị cho vùng quầng thâm mắt.', 'hinh25.jpg', 'MP01', 'NSX005'),
('MP0009', ' PHẤN MÁ BRONZER', 350000, 4, 'phấn má hồng vừa là phấn tạo khối nhằm tạo chiều sâu cho đường nét trên khuôn mặt và làm rạng rỡ khu', 'hinh26.jpg', 'MP01', 'NSX007'),
('MP0010', 'Bút kẻ Stila Stay All Day Eyel', 150000, 2, 'điểm nhấn cho đôi mắt có hồn và sắc sảo hơn.', 'hinh28.jpg', 'MP01', 'NSX004'),
('MP0011', 'Phấn mắt Urban Decay Naked', 220000, 2, 'Chỉ với một chút màu sắc nhẹ nhàng, đôi mắt sẽ trở nên long lanh và cuốn hút.', 'hinh27.jpg', 'MP01', 'NSX008'),
('MP0012', ' Bộ dưỡng da Clinique Moisture', 1230000, 1, 'Chúng bao gồm 4 món: kem dưỡng ẩm, kem mắt, mặt nạ ngủ và túi đựng mỹ phẩm', 'hinh29.jpg', 'MP02', 'NSX005'),
('MP0013', 'Bộ dưởng da ban điểm L\'Oreal P', 2000000, 2, 'chất lượng tuyệt hảo, giảm thâm mụn, nám da rõ rệt, làm sáng da, đều màu da. Trọn', 'hinh30.jpg', 'MP02', 'NSX002'),
('MP0014', 'Bộ dưỡng trắng 6 món OHUI Extr', 2450000, 2, 'cân bằng được lượng dầu và nước trên da, trị nám, ngăn ngừa lão hóa cực hữu hiệu.', 'hinh32.jpg', 'MP02', 'NSX006'),
('MP0015', 'bộ dưởng da chống lão hóa Clin', 1348000, 3, ' làm sạch da hiệu quả, cân bằng độ pH của da, cấp ẩm hữu hiệu và loại bỏ các tế bào chết, bụi bẩn gâ', 'hinh31.jpg', 'MP02', 'NSX008'),
('NH0001', 'Narciso Rodriguez For Her EDP', 400000, 2, 'Với Hương thơm quyến rũ, thích hợp cới sự tươi mới, năng động và hiện đại của phụ nữ ngày nay', 'hinh2.jpg', 'NH01', 'NSX004'),
('NH0002', 'LA VIE EST BELLE EN ROSE', 1800000, 2, ' Sự kết hợp giữa hương hoa diên vĩ cùng hoa mẫu đơn và hoa hồng, thêm một chút nhẹ nhàng, thanh thoá', 'hinh8.jpg', 'NH01', 'NSX010'),
('NH0003', 'MIRACLE BLOSSOM', 2800000, 3, 'Hương hoa trái cây dịu ngọt, Miracle Blossom dịu dàng như nụ hồng e ấp, sẵn sàng nở rộ bất cứ lúc nà', 'hinh9.jpg', 'NH01', 'NSX010'),
('NH0004', 'Chanel Chance Eau Tendre Eau d', 2300000, 1, 'Hương Thơm Tươi Mát, Dịu Dàng, Hiện Đại, Phù Hợp Nơi Công Sở', 'hinh10.jpg', 'NH01', 'NSX006'),
('NH0005', 'Azzaro Chrome Intense for Men ', 800000, 3, 'Hương Đầu: Cam Bergamot, Quả bưởi, Gừng, Hedione', 'hinh11.jpg', 'NH02', 'NSX001'),
('NH0006', 'Bleu De Chanel của Chanel', 1200000, 4, 'tầng hương gỗ của Bleu de Chanel pha trộn với các gam cam quýt tạo nên sự gợi tình rất tinh tế. ', 'hinh12.jpg', 'NH02', 'NSX008'),
('TP0001', 'Viên Uống Chống Nắng Fine Japa', 2700000, 2, 'Làn da của bạn khá nhạy cảm với các thành phần mỹ phẩm và kem chống nắng,', 'hinh13.jpg', 'TP01', 'NSX004'),
('TP0002', 'Viên uống giảm cân hoa quả ISD', 430000, 3, 'Hỗ trợ chế độ ăn uống lành mạnh, tăng cơ, giảm mỡ, tăng cường trao đổi chất, detox thải độc,', 'hinh14.jpg', 'TP01', 'NSX004'),
('TP0003', 'Viên uống đẹp da Innerb Aqua B', 560000, 5, 'Bổ sung Hyaluronic cấp nước và chống hiện tượng da mất cân bằng độ ẩm', 'hinh15.jpg', 'TP01', 'NSX001'),
('TP0004', 'VViên uống giảm cân Green Tea ', 540000, 1, 'Giúp tác động đến các vùng tích mỡ trong cơ thể, từ đó tăng cường đốt cháy và đào thải chúng ra khỏi', 'hinh16.jpg', 'TP01', 'NSX003'),
('TP0005', 'Viên Uống Tinh Chất Nho Health', 700000, 2, 'Hỗ trợ trong việc duy trì lưu thông máu trong bàn tay, bàn chân và chân.', 'hinh17.jpg', 'TP01', 'NSX005'),
('TP0006', 'Tinh dầu Bio-Oil trị Rạn da (6', 240000, 2, 'trong việc phòng chống rạn nứt da, làm mờ vết sẹo, giúp da mịn màng, sáng bóng', 'hinh18.jpg', 'TP02', 'NSX007'),
('TP0007', 'Dưỡng đa năng Lucas', 120000, 5, ' giúp điều trị viêm da do dị ứng, nứt đầu ti ở bà bầu và hăm xước da ở trẻ em, làm giảm các triệu ch', 'hinh9.jpg', 'TP02', 'NSX001'),
('TP0008', 'Kem trị phỏng Biafine', 240000, 2, 'Xử lý vết bỏng đúng, kịp thời sẽ giúp làm dịu, ngăn việc lan rộng vết bỏng, hạn chế da bị tổn thương', 'hinh20.jpg', 'TP02', 'NSX010'),
('TP0009', 'Thuốc nhỏ mắt Muhi Nhật Bản', 145000, 6, 'Đồng thời bảo vệ mắt và hạn chế các bệnh về mắt cho bé một cách hiệu quả', 'hinh21.jpg', 'TP02', 'NSX001'),
('TP0010', 'Nhỏ Mắt Nhật FX NEO Santen', 115000, 3, ' giúp làm sạch mắt và làm giảm mệt mỏi, viêm nhiễm, đau mắt.... của mắt ngay tức thì', 'hinh22.jpg', 'TP02', 'NSX004');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tai_khoan`
--

CREATE TABLE `tai_khoan` (
  `matk` varchar(6) NOT NULL,
  `ID` varchar(30) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tai_khoan`
--

INSERT INTO `tai_khoan` (`matk`, `ID`, `pass`, `role`) VALUES
('TK001', 'ID001', '12234', 1),
('TK002', 'ID002', '23456', 1),
('TK003', 'ID003', '56789', 0),
('TK004', 'ID004', '45678', 1),
('TK005', 'ID005', '24578', 0),
('TK006', 'ID006', '98765', 0),
('TK007', 'ID007', '87654', 0),
('TK008', 'ID008', '76543', 1),
('TK009', 'ID009', '65432', 0),
('TK010', 'ID010', '54321', 1),
('TK011', 'thai', '202cb962ac59075b964b07152d234b70', 1),
('TK012', 'thai1', '202cb962ac59075b964b07152d234b70', 0),
('TK013', 'thai2', '202cb962ac59075b964b07152d234b70', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_chitiet_donhang` (`madon`),
  ADD KEY `FK_chitiet_sp` (`masp`);

--
-- Chỉ mục cho bảng `don_hang`
--
ALTER TABLE `don_hang`
  ADD PRIMARY KEY (`madon`),
  ADD KEY `FK_donhang_taikhoan` (`matk`);

--
-- Chỉ mục cho bảng `khach_hang`
--
ALTER TABLE `khach_hang`
  ADD PRIMARY KEY (`makh`),
  ADD KEY `FK_khachhang_taikhoan` (`matk`);

--
-- Chỉ mục cho bảng `khuyen_mai`
--
ALTER TABLE `khuyen_mai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_khuyenmai_sp` (`masp`);

--
-- Chỉ mục cho bảng `loai_sp`
--
ALTER TABLE `loai_sp`
  ADD PRIMARY KEY (`MaLoai`);

--
-- Chỉ mục cho bảng `nha_san_xuat`
--
ALTER TABLE `nha_san_xuat`
  ADD PRIMARY KEY (`mansx`);

--
-- Chỉ mục cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  ADD PRIMARY KEY (`Masp`),
  ADD KEY `FK_sanpham_loaisp` (`maloai`),
  ADD KEY `FK_sanpham_nsx` (`mansx`);

--
-- Chỉ mục cho bảng `tai_khoan`
--
ALTER TABLE `tai_khoan`
  ADD PRIMARY KEY (`matk`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT cho bảng `khuyen_mai`
--
ALTER TABLE `khuyen_mai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD CONSTRAINT `FK_chitiet_donhang` FOREIGN KEY (`madon`) REFERENCES `don_hang` (`madon`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_chitiet_sp` FOREIGN KEY (`masp`) REFERENCES `san_pham` (`Masp`);

--
-- Các ràng buộc cho bảng `don_hang`
--
ALTER TABLE `don_hang`
  ADD CONSTRAINT `FK_donhang_taikhoan` FOREIGN KEY (`matk`) REFERENCES `tai_khoan` (`matk`);

--
-- Các ràng buộc cho bảng `khach_hang`
--
ALTER TABLE `khach_hang`
  ADD CONSTRAINT `FK_khachhang_taikhoan` FOREIGN KEY (`matk`) REFERENCES `tai_khoan` (`matk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `khuyen_mai`
--
ALTER TABLE `khuyen_mai`
  ADD CONSTRAINT `FK_khuyenmai_sp` FOREIGN KEY (`masp`) REFERENCES `san_pham` (`Masp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  ADD CONSTRAINT `FK_sanpham_loaisp` FOREIGN KEY (`maloai`) REFERENCES `loai_sp` (`MaLoai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_sanpham_nsx` FOREIGN KEY (`mansx`) REFERENCES `nha_san_xuat` (`mansx`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
