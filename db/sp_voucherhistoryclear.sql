USE [ACC]
GO
/****** Object:  StoredProcedure [dbo].[sp_voucherhistoryclear]    Script Date: 8/31/2022 4:24:54 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
ALTER PROCEDURE [dbo].[sp_voucherhistoryclear]
AS
BEGIN
	SET NOCOUNT ON;

    -- Insert statements for procedure here
	--SELECT * FROM storage_user_log
	--WHERE DATEDIFF(day, datetime, CURRENT_TIMESTAMP) > 60
	DELETE FROM storage_user_log WHERE DATEDIFF(day, datetime, CURRENT_TIMESTAMP) > 60
END
