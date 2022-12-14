USE [ACC]
GO
/****** Object:  StoredProcedure [dbo].[sp_voucherdisposal]    Script Date: 8/31/2022 4:24:15 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
--DECLARE @current_user varchar(50)
--SET @current_user = SELECT CURRENT_USER 
--exec [sp_disposalVoucher] 'I04-2207-001', 'Fill The Reason', 'nzainpradana'
ALTER  PROCEDURE [dbo].[sp_voucherdisposal]
	@voucher varchar(50),
	@reason varchar(255),
	@user varchar(50)
AS
BEGIN
	DECLARE @result varchar(50),
	@item_storage_code varchar(15),
	@location_id varchar(50),
	@PaymentTo VARCHAR(255),
	@Particulars VARCHAR(255),
	@BankName VARCHAR(255),
	@Currency VARCHAR(255),
	@softcopy_scan VARCHAR(255),
	@last_upload_time datetime,
	@upload_by VARCHAR(50)


	SET NOCOUNT ON;

	IF EXISTS (SELECT * FROM storage_voucher_registered WHERE VoucherNo = @voucher)
	BEGIN
		SELECT @item_storage_code = item_storage_code, @location_id = location_id, @PaymentTo = PaymentTo, @Particulars = Particulars, @BankName = BankName, @Currency = Currency,
		@softcopy_scan = softcopy_scan, @last_upload_time = last_upload_time, @upload_by = upload_by
		 FROM storage_voucher_registered WHERE VoucherNo = @voucher;

		-- Hapus Voucher dari Registered
		DELETE FROM storage_voucher_registered
		WHERE VoucherNo = @voucher;

		IF @@ROWCOUNT > 0
			BEGIN
				--insert storage disposal
				INSERT INTO storage_voucher_disposal (item_storage_code, VoucherNo, Particulars, PaymentTo, BankName, Currency, reason, created_by, created_date, softcopy_scan, last_upload_time, upload_by)
				VALUES (@item_storage_code, @voucher, @Particulars, @PaymentTo, @BankName, @Currency, @reason, @user, CURRENT_TIMESTAMP, @softcopy_scan, @last_upload_time, @upload_by);

				SET @result = 'success'

				IF @@ROWCOUNT > 0
				BEGIN

					INSERT INTO storage_voucher_history (item_storage_code, VoucherNo, type, location_id, reason, created_by, created_date)
					VALUES (@item_storage_code, @voucher, 'DISPOSAL', @location_id, @reason, @user, CURRENT_TIMESTAMP);

				END
			END
		ELSE
			BEGIN
			SET @result = 'failed'
			END
	END
	ELSE
		BEGIN
			SET @result = 'voucher unregistered'
		END


	SELECT @result as Result
END

