USE [ACC]
GO
/****** Object:  StoredProcedure [dbo].[sp_menudelete]    Script Date: 8/31/2022 4:27:49 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
ALTER PROCEDURE [dbo].[sp_menudelete]
	@menu_id int
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

   DECLARE @parent_menu	int

   SELECT TOP 1 @parent_menu = parent_menu FROM storage_menu WHERE id = @menu_id

   DELETE FROM storage_menu WHERE id = @menu_id

   -- REORDERING
   -- REORDERING LAST PARENT MENU

	DECLARE @menu_order_new int = 1, @menu_id_before int;

	DECLARE C_menu_before CURSOR FOR

	SELECT id menu_id_before FROM storage_menu WHERE parent_menu = @parent_menu ORDER BY menu_order ASC

	OPEN C_menu_before
	FETCH NEXT FROM C_menu_before
	INTO @menu_id_before

	WHILE @@FETCH_STATUS = 0
	BEGIN
		UPDATE storage_menu SET menu_order = @menu_order_new WHERE id = @menu_id_before 

		SET @menu_order_new = @menu_order_new + 1;

		FETCH NEXT FROM C_menu_before
		INTO @menu_id_before
	END

	DECLARE @result VARCHAR(30), @message VARCHAR(100)
	IF(@@ROWCOUNT > 0)
	BEGIN
		SET @result = 'success'
		SET @message	= 'Delete Menu Successfully'

	END
	ELSE
	BEGIN
		SET @result = 'failed'
		SET @message	= 'Failed to Delete Menu'
	END
   
	SELECT @result Result, @message message


END
