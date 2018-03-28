unit URoomList;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, Grids, DBGrids, StdCtrls, Mask, ExtCtrls, ComCtrls, DBCtrls;

type
  TfrmRoomList = class(TForm)
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
    MaskEdit1: TMaskEdit;
    Edit3: TEdit;
    Edit4: TEdit;
    Edit5: TEdit;
    ComboBox1: TComboBox;
    DBGrid1: TDBGrid;
    DBNavigator1: TDBNavigator;
    Bevel1: TBevel;
    Label8: TLabel;
    Label9: TLabel;
    Label10: TLabel;
    Edit6: TEdit;
    Edit7: TEdit;
    Edit8: TEdit;
    Edit9: TEdit;
    Edit10: TEdit;
    Edit11: TEdit;
    Edit12: TEdit;
    Edit13: TEdit;
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  frmRoomList: TfrmRoomList;

implementation

{$R *.dfm}

end.
