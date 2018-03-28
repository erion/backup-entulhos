unit UVoucherHotelaria;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, DBCtrls, Grids, DBGrids, Mask, StdCtrls, ExtCtrls, ComCtrls;

type
  TfrmVoucherHotelaria = class(TForm)
    StatusBar1: TStatusBar;
    Panel1: TPanel;
    Label1: TLabel;
    Label2: TLabel;
    Label3: TLabel;
    Label4: TLabel;
    Label9: TLabel;
    Label10: TLabel;
    Edit1: TEdit;
    Edit2: TEdit;
    Edit3: TEdit;
    ComboBox1: TComboBox;
    MaskEdit3: TMaskEdit;
    DBGrid1: TDBGrid;
    DBNavigator1: TDBNavigator;
    Edit6: TEdit;
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  frmVoucherHotelaria: TfrmVoucherHotelaria;

implementation

{$R *.dfm}

end.
