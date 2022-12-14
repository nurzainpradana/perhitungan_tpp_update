USE [ACC]
GO
/****** Object:  StoredProcedure [dbo].[sp_menuupdate]    Script Date: 8/31/2022 4:28:53 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
--= exec [sp_menuupdate] '', '', '3', '0','','1'
ALTER PROCEDURE [dbo].[sp_menuupdate]
	-- Add the parameters for the stored procedure here
	@id int,
	@menu_level int,
	@menu_name VARCHAR(50),
	@url VARCHAR(100),
	@menu_icon VARCHAR(50),
	@parent_menu int,
	@is_parent_menu int,
	@status int
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

	-- GET PARENT MENU BEFORE
	DECLARE @parent_menu_before int, @menu_order int

	SELECT @parent_menu_before = parent_menu, @menu_order = menu_order FROM storage_menu WHERE id = @id

	IF(@parent_menu <> @parent_menu_before)
	BEGIN
		 -- GET MENU ORDER (JIKA PARENT MENU BERUBAH)
		 -- MELAKUKAN REORDER DI PARENT MENU SEBELUMNYA
	   IF(@parent_menu = 0)
	   BEGIN
			IF EXISTS(SELECT TOP 1 menu_order FROM storage_menu WHERE menu_level = @menu_level ORDER BY menu_order DESC)
			BEGIN
				SELECT TOP 1 @menu_order = menu_order + 1 FROM storage_menu WHERE menu_level = @menu_level ORDER BY menu_order DESC
			END
			ELSE
			BEGIN
				SET @menu_order = 1
			END
	   END
	   ELSE
	   BEGIN
			IF EXISTS(SELECT TOP 1 menu_order FROM storage_menu WHERE menu_level = @menu_level AND parent_menu = @parent_menu ORDER BY menu_order DESC)
			BEGIN
				SELECT TOP 1 @menu_order = menu_order + 1 FROM storage_menu WHERE menu_level = @menu_level AND parent_menu = @parent_menu ORDER BY menu_order DESC
			END
			ELSE
			BEGIN
				SET @menu_order = 1
			END
	   END

	   -- UPDATE MENU
	   UPDATE storage_menu 
	   SET menu_name = @menu_name, menu_level = @menu_level, is_parent_menu = @is_parent_menu, [url] = @url, parent_menu = @parent_menu, menu_order = @menu_order, status = @status, menu_icon = @menu_icon
	   WHERE id = @id

	   -- REORDERING LAST PARENT MENU

		DECLARE @menu_order_new int = 1, @menu_id_before int;

		DECLARE C_menu_before CURSOR FOR

		SELECT id menu_id_before FROM storage_menu WHERE parent_menu = @parent_menu_before ORDER BY menu_order ASC

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
	END

	ELSE
	BEGIN
		-- UPDATE MENU
	   UPDATE storage_menu 
	   SET menu_name = @menu_name, menu_level = @menu_level, is_parent_menu = @is_parent_menu, parent_menu = @parent_menu, [url] = @url, menu_order = @menu_order, status = @status, menu_icon = @menu_icon
	   WHERE id = @id
	END
   
   DECLARE @result VARCHAR(30)

   IF(@@ROWCOUNT > 0)
   BEGIN
		SET @result = 'success'
   END
   ELSE
   BEGIN
		SET @result = 'failed'
   END
   
   SELECT @result Result
   
END

