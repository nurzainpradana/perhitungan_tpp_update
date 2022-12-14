USE [ACC]
GO
/****** Object:  StoredProcedure [dbo].[sp_menuinsert]    Script Date: 8/31/2022 4:28:23 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
--= exec sp_menuinsert 'CREATE LOCATION', '', '3', '0','','1'
ALTER PROCEDURE [dbo].[sp_menuinsert]
	-- Add the parameters for the stored procedure here
	@menu_name VARCHAR(50),
	@url VARCHAR(100),
	@menu_level int,
	@is_parent_menu int,
	@parent_menu int,
	@menu_icon VARCHAR(50),
	@status int
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

	DECLARE @menu_order int;

   -- GET MENU ORDER
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

   -- insert
   INSERT INTO storage_menu(menu_name, menu_level, is_parent_menu, parent_menu, [url], menu_order, status, menu_icon)
   VALUES (@menu_name, @menu_level, @is_parent_menu, @parent_menu, @url, @menu_order, @status, @menu_icon)

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
