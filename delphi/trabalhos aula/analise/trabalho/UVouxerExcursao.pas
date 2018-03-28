unit UVouxerExcursao;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, DBCtrls, Grids, DBGrids, Mask, StdCtrls, ExtCtrls, ComCtrls;

type
  TfrmVoucherExcursao = class(TForm)
    StatusBar1: TStatusBar;
    Panel1: TPanel;
    Label1: TLabel;
    Label2: TLabel;
    Label3: TLabel;
    Label4: TLabel;
    Label5: TLabel;
    Label6: TLabel;
    Label7: TLabel;
    Label8: TLabel;
    Label9: TLabel;
    Edit1: TEdit;
    Edit2: TEdit;
    Edit3: TEdit;
    ComboBox1: TComboBox;
    Edit4: TEdit;
    MaskEdit1: TMaskEdit;
    MaskEdit2: TMaskEdit;
    Edit5: TEdit;
    MaskEdit3: TMaskEdit;
    DBGrid1: TDBGrid;
    DBNavigator1: TDBNavigator;
    Edit6: TEdit;
    Label10: TLabel;
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  frmVoucherExcursao: TfrmVoucherExcursao;

implementation

{$R *.dfm}

end.
