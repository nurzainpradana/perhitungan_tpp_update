USE [ACC]
GO
/****** Object:  StoredProcedure [dbo].[sp_voucherrestore]    Script Date: 8/31/2022 4:26:25 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


--DECLARE @current_user varchar(50)
--SET @current_user = SELECT CURRENT_USER 
--exec [sp_restoreVoucher] '014-2207-001', 'ZIP5-1-1A', 'nzainpradana'
ALTER  PROCEDURE [dbo].[sp_voucherrestore]
	@voucher varchar(50),
	@location_name varchar(50),
	@user varchar(50)
AS
BEGIN
	DECLARE @result varchar(50),  @counter int = 1,  @PaymentTo varchar(255), @item_storage_code VARCHAR(15)
	,@Particulars varchar(255), @BankName varchar(255), @Currency char(3),
	@location_id varchar(50), 
	@softcopy_scan VARCHAR(255),
	@last_upload_time datetime,
	@upload_by VARCHAR(50)


	SET NOCOUNT ON;

	-- Check apakah data location ada di database
	IF EXISTS (SELECT * FROM storage_location WHERE location_name = @location_name)
	BEGIN
		SELECT @location_id = id FROM storage_location WHERE location_name = @location_name
			BEGIN
				IF NOT EXISTS (SELECT VoucherNo FROM storage_voucher_registered WHERE VoucherNo = @voucher)
				BEGIN
					SELECT @item_storage_code = item_storage_code, @PaymentTo = PaymentTo, @Particulars = Particulars, @BankName = BankName, @Currency = Currency, @softcopy_scan = softcopy_scan, @last_upload_time = last_upload_time,
					@upload_by = upload_by FROM storage_voucher_disposal WHERE VoucherNo = @voucher


					INSERT storage_voucher_registered (item_storage_code, VoucherNo, location_id, status, created_by, created_date, PaymentTo, Particulars, BankName, Currency, softcopy_scan, last_upload_time, upload_by)
					VALUES (@item_storage_code, @voucher, @location_id, 1, @user, CURRENT_TIMESTAMP, @PaymentTo, @Particulars, @BankName, @Currency, @softcopy_scan, @last_upload_time, @upload_by)

					IF @@ROWCOUNT > 0
					BEGIN
					INSERT INTO storage_voucher_history (item_storage_code, VoucherNo, type, location_id, created_by, created_date)
					VALUES (@item_storage_code, @voucher, 'RESTORE', @location_id, @user, CURRENT_TIMESTAMP);

					DELETE FROM storage_voucher_disposal WHERE VoucherNo = @voucher;

					SET @result = 'success'
					END
					ELSE
					BEGIN
					SET @result = 'failed'
					END
				END
				ELSE
				BEGIN
					SET @result = 'exists'
				END
			END
	END
	ELSE
		-- Jika Lokasi tidak ada di database
		BEGIN
			SET @result = 'location unregistered'
		END


	SELECT @result as Result
END


