USE [ACC]
GO
/****** Object:  StoredProcedure [dbo].[sp_menuorderup]    Script Date: 8/31/2022 4:28:41 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
ALTER PROCEDURE [dbo].[sp_menuorderup]
	@menu_id int
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

    DECLARE @order_before int, @order_current int, @parent_menu int, @menu_id_before int, @menu_id_current int

	SELECT TOP 1 @parent_menu = parent_menu, @order_before = (menu_order - 1), @order_current = menu_order FROM storage_menu WHERE id = @menu_id

	SELECT @menu_id_before = id FROM storage_menu WHERE parent_menu = @parent_menu AND menu_order = @order_before
	SELECT @menu_id_current = id FROM storage_menu WHERE parent_menu = @parent_menu AND menu_order = @order_current

	UPDATE storage_menu SET menu_order = @order_current WHERE id = @menu_id_before
	
	UPDATE storage_menu SET menu_order = @order_before WHERE id = @menu_id_current

	DECLARE @result VARCHAR(30), @message VARCHAR(100)

   IF(@@ROWCOUNT > 0)
   BEGIN
		SET @result = 'success'
		SET @message	= 'Order Up Successfully'

   END
   ELSE
   BEGIN
		SET @result = 'failed'
		SET @message	= 'Failed to Order Up'
   END
   
   SELECT @result Result, @message message




END
