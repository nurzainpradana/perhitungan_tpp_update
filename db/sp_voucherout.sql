USE [ACC]
GO
/****** Object:  StoredProcedure [dbo].[sp_voucherout]    Script Date: 8/31/2022 4:26:06 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
--DECLARE @current_user varchar(50)
--SET @current_user = SELECT CURRENT_USER 
--exec [sp_VoucherOut] 'I04-2207-001', 'nzainpradana'
ALTER  PROCEDURE [dbo].[sp_voucherout]
	@voucher varchar(50),
	@user varchar(50)
AS
BEGIN
	DECLARE @result varchar(50),
	@location_id varchar(50),
	@item_storage_code varchar(15)

	SET NOCOUNT ON;

	IF EXISTS (SELECT * FROM storage_voucher_registered WHERE VoucherNo = @voucher)
	BEGIN
		SELECT @location_id = location_id, @item_storage_code = item_storage_code FROM storage_voucher_registered WHERE VoucherNo = @voucher;

		--PROCESS OUT
		UPDATE storage_voucher_registered
		SET status = 0, last_update = CURRENT_TIMESTAMP, updated_by = @user, out_by = @user, out_date = CURRENT_TIMESTAMP
		WHERE VoucherNo = @voucher;

		IF @@ROWCOUNT > 0
		BEGIN
		INSERT INTO storage_voucher_history (item_storage_code, VoucherNo, type, location_id, created_by, created_date)
		VALUES (@item_storage_code, @voucher, 'OUT', @location_id, @user, CURRENT_TIMESTAMP)
		SET @result = 'success'
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

