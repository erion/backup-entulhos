unit UVoucherLocacaoVeiculos;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, DBCtrls, Grids, DBGrids, Mask, StdCtrls, ExtCtrls, ComCtrls;

type
  TfrmVoucherLocacaoVeiculos = class(TForm)
    StatusBar1: TStatusBar;
    Panel1: TPanel;
    Label1: TLabel;
    Label2: TLabel;
    Label3: TLabel;
    Label4: TLabel;
    Label8: TLabel;
    Label9: TLabel;
    Label10: TLabel;
    Edit1: TEdit;
    Edit2: TEdit;
    Edit3: TEdit;
    ComboBox1: TComboBox;
    Edit5: TEdit;
    MaskEdit3: TMaskEdit;
    DBGrid1: TDBGrid;
    DBNavigator1: TDBNavigator;
    Edit6: TEdit;
    Edit4: TEdit;
    Label5: TLabel;
    Edit7: TEdit;
    Label6: TLabel;
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  frmVoucherLocacaoVeiculos: TfrmVoucherLocacaoVeiculos;

implementation

{$R *.dfm}

end.
