unit UCadFornecedor;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, ExtCtrls, ComCtrls, DBCtrls, StdCtrls, Grids, DBGrids;

type
  TfrmCadastroFornecedor = class(TForm)
    StatusBar1: TStatusBar;
    Panel1: TPanel;
    Label1: TLabel;
    Label2: TLabel;
    Label3: TLabel;
    Label4: TLabel;
    Label5: TLabel;
    Label6: TLabel;
    Label7: TLabel;
    Edit1: TEdit;
    Edit2: TEdit;
    Edit3: TEdit;
    Edit4: TEdit;
    Edit5: TEdit;
    Edit7: TEdit;
    Edit8: TEdit;
    Edit9: TEdit;
    ComboBox1: TComboBox;
    DBNavigator1: TDBNavigator;
    Label8: TLabel;
    GroupBox1: TGroupBox;
    DBGrid1: TDBGrid;
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  frmCadastroFornecedor: TfrmCadastroFornecedor;

implementation

{$R *.dfm}

end.
